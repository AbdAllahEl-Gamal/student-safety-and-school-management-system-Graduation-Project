<?php
namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\DocumentSnapshot;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;
use App\Mail\sendMail;
use Mapper;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class formsCont extends Controller
{
	public function insertEmployee(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'fullname' => 'required' ,
			'gender' => 'required' ,
			'dateofbirth' => 'required' ,
			'position' => 'required' ,
			'phonenumber' => 'required|min:11',
			'employeephoto' => 'required'
		]);
		$employeePic=base64_encode(file_get_contents($request->file('employeephoto')->getPathName()));
		$pass=Hash::make($request->input('password'));
		$documentEmployee = $firestore->collection('employees')->document($request->input('phonenumber'));
		$documentEmployee->set([
			'name' => $request->input('fullname') ,
			'gender' => $request->input('gender') ,
			'dateofbirth' => $request->input('dateofbirth') ,
			'position' => $request->input('position') ,
			'email' => $request->input('email') ,
			'password' => $pass,
			'pic' => $employeePic
		]);
		return redirect('admin');
	}
	public function insertStudent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'studentId' => 'required' ,
			'studentname' => 'required' ,
			'parentname' => 'required' ,
			'parentphonenumber' => 'required' ,
			'class' => 'required' ,
			'gender' => 'required',
			'studentphoto' => 'required'
		]);
		
		$profilePic=base64_encode(file_get_contents($request->file('studentphoto')->getPathName()));


		$documentStudent = $firestore->collection('students')->document($request->input('studentId'));
		$documentStudent->set([
			'name' => $request->input('studentname').' '.$request->input('parentname') ,
			'class' => $request->input('class'),
			'parentPhone' =>$request->input('parentphonenumber'),
			'gender' =>$request->input('gender'),
			'pic'=>$profilePic,
			'busnumber'=>'',
			'attendance'=>'',
			'password'=>$request->input('password'),
			'added_at' =>date('d-m-Y h:i:s')
		]);

		$subjects = $firestore->collection('class_sub')->document($request->input('class'));
		$snapshot = $subjects->snapshot();
		for ($i=0; $i < count($snapshot['subjects']); $i++) { 
			$documentStudent = $firestore->collection('students')->document($request->input('studentId'))->collection('subjects')->document($snapshot['subjects'][$i])->set([
				'quizzes' => '',
				'midterm' => '',
				'final' => ''
			],['merge'=>true]);
		}

		$obj=array($request->input('studentId') => [
			'name' => $request->input('studentname'),'class' => $request->input('class'),'pic'=>$profilePic
		]);
		$documentStudentP = $firestore->collection('parents')->document($request->input('parentphonenumber'));
		$documentStudentP->set([
			'children' => $obj
		],['merge'=>true]);

		$documentStudent = $firestore->collection('classrooms')->where("class","=",$request->input('class'));
		$querey=$documentStudent->documents();
		$classId="";
		$numberOfstudents=0;
		foreach ($querey as $key) {
			$classId=$key->id();
			$numberOfstudents=intval($key->fields()['studentsNumber'])+1;
		}
		$documentStudentP = $firestore->collection('classrooms')->document($classId);
		$documentStudentP->set([
			'studentsNumber' => $numberOfstudents
		],['merge'=>true]);

		
		if ($request->input('submitBtn')=='submit') {
			return redirect('admin');
		}else if ($request->input('submitBtn')=='addNew') {
			return redirect('student');
		}
	}
	public function insertParent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'fullname' => 'required' ,
			'phonenumber' => 'required' ,
			'email' => 'required' ,
			'password' => 'required'
		]);
		$pass=Hash::make($request->input('password'));
		$documentParent = $firestore->collection('parents')->document($request->input('phonenumber'));
		$documentParent->set([
			'name' => $request->input('fullname') ,
			'email' => $request->input('email') ,
			'password' => $pass
		]);
		return redirect('student');
	}
	public function insertBus(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'busID' => 'required' ,
			'driver' => 'required' ,
			'supervisor' => 'required'
		]);
		$documentParent = $firestore->collection('bus')->document($request->input('busID'));
		$documentParent->set([
			'driver name' => $request->input('driverName') ,
			'supervisor name' => $request->input('supervisorName'),
			'supervisor phone' => $request->input('supervisor'),
			'driver phone' => $request->input('driver'),
			'line' => $request->input('line')
		]);
		return redirect('admin');
	}
	public function busUpdate1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'busid' => 'required'
		]);
		$collectionReference = $firestore->collection('bus');
		$documentReference = $collectionReference->document($request->input('busid'));
		$busid = $request->input('busid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('busUpdate')->withErrors('The bus ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$drivername = $snapshot['driver name'];
			$supervisorname = $snapshot['supervisor name'];
			$line = $snapshot['line'];

			$collection = $firestore->collection('employees');
			$query = $collection->where('position', '=','driver');
			$snapshot = $query->documents();
			$driverIds=array();
			$driverNames=array();
			foreach ($snapshot as $user){
				array_push($driverIds,$user->id());
				array_push($driverNames,$user['name']);
			}
			$collection = $firestore->collection('employees');
			$query = $collection->where('position', '=','bus supervisor');
			$snapshot = $query->documents();
			$supervisorIds=array();
			$supervisorNames=array();
			foreach ($snapshot as $user){
				array_push($supervisorIds,$user->id());
				array_push($supervisorNames,$user['name']);
			}
			$collectionReference = $firestore->collection('lines')->documents();
			$liness=array();
			foreach ($collectionReference as $key) {
				$liness[$key->id()]=$key->fields();
			}
			return view('bus_update',compact('drivername','supervisorname','line','busid','driverIds','driverNames','supervisorIds','supervisorNames','liness'));
		}
	}
	public function updateBus(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentStudent = $firestore->collection('bus')->document($request->input('busID'));
		$documentStudent->update([
			['path' => 'driver name', 'value' => $request->input('driverName')],
			['path' => 'supervisor name', 'value' => $request->input('supervisorName')],
			['path' => 'supervisor phone', 'value' => $request->input('supervisor')],
			['path' => 'driver phone', 'value' => $request->input('driver')],
			['path' => 'line', 'value' => $request->input('line')]
		]);
		return redirect('busUpdate');
	}
	public function busDelete1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'busid' => 'required'
		]);
		$collectionReference = $firestore->collection('bus');
		$documentReference = $collectionReference->document($request->input('busid'));
		$busid = $request->input('busid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('busDelete')->withErrors('The bus ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$drivername = $snapshot['driver name'];
			$supervisorname = $snapshot['supervisor name'];
			$line = $snapshot['line'];

			return view('bus_delete',compact('drivername','supervisorname','line','busid'));
		}
	}
	public function busDelete2(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('bus')->document($request->input('busid2'));
		$documentParent -> delete();
		return redirect('admin');
	}

	public function uploadTimetable(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'class' => 'required' ,
			'timetableimage' => 'required|image'
		]);
		
		$timetablePic=base64_encode(file_get_contents($request->file('timetableimage')->getPathName()));
		$documentStudent = $firestore->collection('timetables')->document($request->input('class'));
		$documentStudent->set([
			'pic'=>$timetablePic
		]);

		/*$file = $request->file('timetableimage');

		$getimageName = $request->input('class').'.'.$file->getClientOriginalExtension();
		$file->move(public_path('images'), $getimageName);
		
		$bucket = $storage->bucket('pua-school.appspot.com');
		$bucket->upload(
			fopen(public_path('images').'/'.$getimageName, 'r'),
			['name' =>'timetables/'.$getimageName]
		);
		File::Delete(public_path('images').'/'.$getimageName);*/
		return redirect('admin');
	}
	public function uploadSheet(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'subject' => 'required' ,
			'sheet' => 'required|mimes:pdf',
			'class' => 'required'
		]);
		$sheet=base64_encode(file_get_contents($request->file('sheet')->getPathName()));
		
		$documentStudentP = $firestore->collection('sheets')->document($request->input('class'))->collection($request->input('subject'));
		$documentStudentP->add([
			'sheet' => $sheet,
			'name' => pathinfo($request->file('sheet')->getClientOriginalName(), PATHINFO_FILENAME)
		]);
		return redirect()->back()->withErrors('File uploaded successfully.');
	}
	public function returnStudent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'classs' => 'required' ,
			'period' => 'required'
		]);
		$collection = $firestore->collection('students');
		$query = $collection->where('class', '=',$request->input('classs'));
		$snapshot = $query->documents();
		$ids=array();
		$names=array();
		foreach ($snapshot as $user){
			array_push($ids,$user->id());
			array_push($names,$user['name']);
		}
		return view('attendance1')->with('ids',$ids)->with('names',$names)->with('period',$request->input('period'));
	}
	public function insertAttend(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$status=$request->input('status');
		$ids=$request->input('ids');
		$validation = $request->validate([
			'status' => 'required'
		]);
		
		for ($i=0; $i <count($ids) ; $i++) {
			$documentParent = $firestore->collection('students')->document($ids[$i]);
			$obj=array(date('d-m-Y') => [$request->input('period') => $status[$i]]);
			$documentParent->set([
				'attendance' => $obj
			],['merge'=>true]);
		}
		return redirect('teacher');
	}
	
	public function login(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'form-username' => 'required' ,
			'form-password' => 'required'
		]);
		if (strlen($request->input('form-username'))==6) {
			$snapshot = $firestore->collection('students')->document($request->input('form-username'))->snapshot();
			if ($snapshot['password']==$request->input('form-password')) {
				session(['id' => $request->input('form-username'),'name' => $snapshot['name'],'classs' => $snapshot['class'],'pic'=>$snapshot['pic']]);
				return redirect('studentProfile/'.$request->input('form-username'));
			}
			else{
				return redirect()->back()->withErrors('Wrong Username OR Password');
			}
		}
		$collectionReference = $firestore->collection('employees');
		$documentReference = $collectionReference->document($request->input('form-username'));
		$snapshot = $documentReference->snapshot();
		if (Hash::check($request->input('form-password'), $snapshot['password'])) {
			if ($snapshot['position'] == 'admin') {
				session(['status'=>'logged','name'=>$snapshot['name'],'position'=>$snapshot['position']]);
				session(['id'=>$request->input('form-username')]);
				return redirect('admin');
			}elseif ($snapshot['position'] == 'teacher') {
				session(['status'=>'logged','name'=>$snapshot['name'],'position'=>$snapshot['position']]);
				session(['id'=>$request->input('form-username'),'pic'=>$snapshot['pic']]);
				return redirect('teacher');
			}else{
				return redirect()->back()->withErrors('You have no access on system');
			}
		}
		else{
			return redirect()->back()->withErrors('Wrong Username OR Password');
		}
	}
	
	public function loginStudent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'studentusername' => 'required' ,
			'studentpassword' => 'required'
		]);
		
		$snapshot = $firestore->collection('students')->document($request->input('studentusername'))->snapshot();
		if ($snapshot['password']==$request->input('studentpassword')) {
			session(['id' => $request->input('studentusername'),'name' => $snapshot['name'],'classs' => $snapshot['class'],'pic'=>$snapshot['pic']]);
			return redirect('studentProfile/'.$request->input('studentusername'));
		}
		else{
			return redirect()->back()->withErrors('Wrong Username OR Password');
		}
	}
	
	public function loginEmployee(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'employeeusername' => 'required' ,
			'employeepassword' => 'required'
		]);
		
		$collectionReference = $firestore->collection('employees');
		$documentReference = $collectionReference->document($request->input('employeeusername'));
		$snapshot = $documentReference->snapshot();
		if (Hash::check($request->input('employeepassword'), $snapshot['password'])) {
			if ($snapshot['position'] == 'admin') {
				session(['status'=>'logged','name'=>$snapshot['name'],'position'=>$snapshot['position']]);
				session(['id'=>$request->input('employeeusername')]);
				return redirect('admin');
			}elseif ($snapshot['position'] == 'teacher') {
				session(['status'=>'logged','name'=>$snapshot['name'],'position'=>$snapshot['position']]);
				session(['id'=>$request->input('employeeusername'),'pic'=>$snapshot['pic']]);
				return redirect('teacher');
			}else{
				return redirect()->back()->withErrors('You have no access on system');
			}
		}
		else{
			return redirect()->back()->withErrors('Wrong Username OR Password');
		}
	}
	
	public function loginParent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'parentusername' => 'required' ,
			'parentpassword' => 'required'
		]);
		
		$collectionReference = $firestore->collection('parents');
		$documentReference = $collectionReference->document($request->input('parentusername'));
		$snapshot = $documentReference->snapshot();
		
		if (Hash::check($request->input('parentpassword'), $snapshot['password'])) {
			session(['status'=>'logged','name'=>$snapshot['name']]);
			session(['id'=>$request->input('parentusername')]);
			return redirect('parentPanel');
		}
		else{
			return redirect()->back()->withErrors('Wrong Username OR Password');
		}
	}
	
	public function returnGrades(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'class' => 'required' ,
			'subject' => 'required' ,
			'gradeType' => 'required'
		]);
		$collection = $firestore->collection('students');
		$query = $collection->where('class', '=',$request->input('class'));
		$snapshot = $query->documents();
		$ids=array();
		$names=array();
		foreach ($snapshot as $user){
			array_push($ids,$user->id());
			array_push($names,$user['name']);
		}
		return view('grades1')->with('ids',$ids)->with('names',$names)->with('subject',$request->input('subject'))->with('gradeType',$request->input('gradeType'));
	}	
	public function insertGrades(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$grade=$request->input('grades');
		$ids=$request->input('ids');
		$validation = $request->validate([
			'grades' => 'required'
		]);
		
		for ($i=0; $i <count($ids) ; $i++) {
			$documentParent = $firestore->collection('students')->document($ids[$i])->collection('subjects')->document($request->input('subject'));
			$documentParent->set([
				$request->input('gradeType') => $grade[$i]
			],['merge'=>true]);
		}
		return redirect('teacher');
	}
	public function accessStudent(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'studentid' => 'required'
		]);
		$subjects=array();
		$collectionReference = $firestore->collection('students');
		$documentReference = $collectionReference->document($request->input('studentid'));
		$snapshot = $documentReference->snapshot();
		$name = $snapshot['name'];
		$class = $snapshot['class'];
		$parentPhone = $snapshot['parentPhone'];
		$bus = $snapshot['busnumber'];
		
		$sub=$documentReference->collection('subjects')->documents();
		foreach ($sub as $key) {
			$subjects[$key->id()] = $key->fields();
		}
		

		$attendance = $snapshot['attendance'];
		$pic='data:image/png;base64,'.$snapshot['pic'];
		$supername='';
		$superphone='';
		$timetablepic='';
		$snapshot2 = $firestore->collection('timetables')->document($class)->snapshot();
		$timetablepic = '';
		if(isset($snapshot2['pic'])){
			$timetablepic = 'data:image/png;base64,'.$snapshot2['pic'];
		}
		if($bus){
			$collectionReference2 = $firestore->collection('bus');
			$documentReference2 = $collectionReference2->document($bus);
			$snapshot2 = $documentReference2->snapshot();
			$supername = $snapshot2['supervisor name'];
			$superphone = $snapshot2['supervisor phone'];
		}
		return view('studentaccess',compact('name','class','bus','supername','superphone','subjects','attendance','parentPhone','pic','timetablepic'));
	}
	public function NotificationSingleDevice(Request $request){
		$validation = $request->validate([
			'title_notification' => 'required' ,
			'msg_body' => 'required',
			'tokenID'=>'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$collectionReference = $firestore->collection('parents');
		$documentReference = $collectionReference->document($request->input('tokenID'));
		$snapshot = $documentReference->snapshot();
		$token=$snapshot['token'];


		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(10);

		$notificationBuilder = new PayloadNotificationBuilder($request->input('title_notification'));
		$notificationBuilder->setBody($request->input('msg_body'))->setSound('default');
		
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();

		//$token = "crfXFAN7ozk:APA91bFz0a-MfPfrSpgZQnw88kjVXA4NrY5f8PLsWG0jH4kjnnizfG4RlF2OwIn0SW0qcZ4xmMjPegGIV4a9Cdhufh8XXwVaQ46RcwdytNWecdC8eQG2NtStPjhqCgIqJuRbBNhxtWIM";

		$downstreamResponse = FCM::sendTo($token, $option, $notification);

		if ($downstreamResponse->numberSuccess()>0) {
			return redirect('notification');
		}else{
			return redirect('notification')->withErrors("notification is not sent");
		}
	} 
	public function NotificationMultiDevice(Request $request){
		$validation = $request->validate([
			'title_notification' => 'required' ,
			'msg_body' => 'required',
			'tokenArray'=>'required',
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$phones=($request->input('tokenArray'));
		$arrayss = explode(";", $phones);
		$tokens=array();
		for ($i=0; $i < count($arrayss); $i++) { 
			$collectionReference = $firestore->collection('parents');
			$documentReference = $collectionReference->document($arrayss[$i]);
			$snapshot = $documentReference->snapshot();
			array_push($tokens,$snapshot['token']);
		}
		

		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(10);

		$notificationBuilder = new PayloadNotificationBuilder($request->input('title_notification'));
		$notificationBuilder->setBody($request->input('msg_body'))->setSound('default');

		
		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		
         //hesham--> d7iZagFAPgQ:APA91bGCHvvHyBPaihhq_kVcV6mBIrnwMphg0sgCtzWwYqhc0AlQuXjS3qMaSqZ8vu_hK_cFi1YmkyyVqgv-sNjpNtgDKhEHo7uqCs6JncMbX8DDdnbEw3T50EtC1AyPm0dupkAPEQDI
		//$token = "crfXFAN7ozk:APA91bFz0a-MfPfrSpgZQnw88kjVXA4NrY5f8PLsWG0jH4kjnnizfG4RlF2OwIn0SW0qcZ4xmMjPegGIV4a9Cdhufh8XXwVaQ46RcwdytNWecdC8eQG2NtStPjhqCgIqJuRbBNhxtWIM";
        //$tokens = MYDATABASE::pluck('fcm_token')->toArray();

		$downstreamResponse = FCM::sendTo($tokens, $option, $notification);

		if ($downstreamResponse->numberSuccess()>0) {
			return redirect('notification');
		}else{
			return redirect('notification')->withErrors("notification is not sent");
		}	
	}
	public function NotificationSingleTopic(Request $request){
		$validation = $request->validate([
			'title_notification' => 'required' ,
			'msg_body' => 'required',
			'topicID'=>'required'
		]);
		// all devices  
		// sana derasya 5
		// fasl mo3ayn 5A

		$notificationBuilder = new PayloadNotificationBuilder($request->input('title_notification'));
		$notificationBuilder->setBody($request->input('msg_body'))->setSound('default');

		$notification = $notificationBuilder->build();

		$topic = new Topics();
		$topic->topic($request->input('topicID'));
		$topicResponse = FCM::sendToTopic($topic, null, $notification, null);

		if ($topicResponse->isSuccess()) {
			return redirect('notification');
		}else{
			return redirect('notification')->withErrors("notification is not sent");
		}
	}
	public function NotificationMultiTopic(Request $request){
		$validation = $request->validate([
			'title_notification' => 'required' ,
			'msg_body' => 'required',
			'topicArray'=>'required'
			
		]);

		$notificationBuilder = new PayloadNotificationBuilder($request->input('title_notification'));
		$notificationBuilder->setBody($request->input('msg_body'))->setSound('default');

		$notification = $notificationBuilder->build();
		
		$topic = new Topics();
		$topics=($request->input('topicArray'));
		$arrays = explode(";", $topics);
		$topic->topic($arrays[0]);
		for ($i=1; $i < count($arrays); $i++) { 
			$topic->orTopic($arrays[$i]);
		}

		$topicResponse = FCM::sendToTopic($topic, null, $notification, null);
		if ($topicResponse->isSuccess()) {
			return redirect('notification');
		}else{
			return redirect('notification')->withErrors("notification is not sent");
		}
	}
	public function employeeUpdate(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'employeeid' => 'required'
		]);
		$collectionReference = $firestore->collection('employees');
		$documentReference = $collectionReference->document($request->input('employeeid'));
		$employeeid = $request->input('employeeid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('employee')->withErrors('The employee ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$name = $snapshot['name'];
			$password = $snapshot['password'];
			$position = $snapshot['position'];
			$gender = $snapshot['gender'];
			$email = $snapshot['email'];
			$dateofbirth = $snapshot['dateofbirth'];
			return view('employee',compact('name','password','position','gender','email','dateofbirth','employeeid'));
		}
	}
	public function employeeUpdate1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentEmployee = $firestore->collection('employees')->document($request->input('employeeid2'));
		$documentEmployee->update([
			['path' => 'name', 'value' => $request->input('fullname')],
			['path' => 'position', 'value' => $request->input('position')],
			['path' => 'email', 'value' => $request->input('email')],
			['path' => 'dateofbirth', 'value' => $request->input('dateofbirth')],
			['path' => 'password', 'value' => $request->input('password')]
		]);
		return redirect('employee');
	}
	public function employeeCUpdate1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('employee');
	}
	public function parentUpdate(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'parentid' => 'required'
		]);
		$collectionReference = $firestore->collection('parents');
		$documentReference = $collectionReference->document($request->input('parentid'));
		$parentid = $request->input('parentid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('parent')->withErrors('The parent ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$name = $snapshot['name'];
			$email = $snapshot['email'];
			$password = $snapshot['password'];
			return view('parent',compact('name','password','email','parentid'));
		}
	}
	public function parentUpdate1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('parents')->document($request->input('parentid2'));
		$documentParent->update([
			['path' => 'name', 'value' => $request->input('fullname')],
			['path' => 'email', 'value' => $request->input('email')],
			['path' => 'password', 'value' => $request->input('password')]
		]);
		return redirect('parent');
	}
	public function parentCUpdate1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('parent');
	}
	public function studentUpdate(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'studentid' => 'required'
		]);
		$collectionReference = $firestore->collection('students');
		$documentReference = $collectionReference->document($request->input('studentid'));
		$studentid = $request->input('studentid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('student')->withErrors('The student ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$name = $snapshot['name'];
			$class = $snapshot['class'];
			return view('student',compact('name','class','studentid'));
		}
	}
	public function studentUpdate1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentStudent = $firestore->collection('students')->document($request->input('studentid2'));
		$documentStudent->update([
			['path' => 'name', 'value' => $request->input('fullname')],
			['path' => 'class', 'value' => $request->input('class')]
		]);
		return redirect('student');
	}
	public function updateStudentPass(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentStudent = $firestore->collection('students')->document($request->input('studentID'));
		$documentStudent->update([
			['path' => 'password', 'value' => $request->input('password')]
		]);
		return redirect('admin');
	}
	public function studentCUpdate1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('student');
	}
	public function employeeDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'employeeid' => 'required'
		]);
		$collectionReference = $firestore->collection('employees');
		$documentReference = $collectionReference->document($request->input('employeeid'));
		$employeeid = $request->input('employeeid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('employee')->withErrors('The employee ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$namee = $snapshot['name'];
			$password = $snapshot['password'];
			$position = $snapshot['position'];
			$gender = $snapshot['gender'];
			$email = $snapshot['email'];
			$dateofbirth = $snapshot['dateofbirth'];
			return view('employee',compact('namee','password','position','gender','email','dateofbirth','employeeid'));	
		}
	}
	public function employeeDelete1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentEmployee = $firestore->collection('employees')->document($request->input('employeeid2'));
		$documentEmployee -> delete();
		return redirect('employee');
	}
	public function employeeCDelete1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('employee');
	}
	public function parentDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'parentid' => 'required'
		]);
		$collectionReference = $firestore->collection('parents');
		$documentReference = $collectionReference->document($request->input('parentid'));
		$parentid = $request->input('parentid');
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('parent')->withErrors('The parent ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$namee = $snapshot['name'];
			$password = $snapshot['password'];
			$email = $snapshot['email'];
			return view('parent',compact('namee','password','email','parentid'));
		}
	}
	public function parentDelete1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('parents')->document($request->input('parentid2'));
		$documentParent -> delete();
		return redirect('parent');
	}
	public function parentCDelete1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('parent');
	}
	public function studentDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'studentid' => 'required'
		]);
		$studentid = $request->input('studentid');
		$collectionReference = $firestore->collection('students');
		$documentReference = $collectionReference->document($request->input('studentid'));
		$snapshot = $documentReference->snapshot();
		if ( !$snapshot->exists() )
		{
			return redirect('student')->withErrors('The student ID you entered does not exist.');
		}
		else
		{
			$snapshot = $documentReference->snapshot();
			$namee = $snapshot['name'];
			$class = $snapshot['class'];
			return view('student',compact('namee','class','studentid'));
		}
	}
	public function studentDelete1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentStudent = $firestore->collection('students')->document($request->input('studentid2'));
		$documentStudent -> delete();
		return redirect('student');
	}
	public function studentCDelete1(){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return redirect('student');
	}
	public function student_Bus1(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'bus_id' => 'required'
		]);
		$documentParent = $firestore->collection('students')->document($request->input('id'));
		$documentParent->set([
			'busnumber' => $request->input('bus_id')
		],['merge'=>true]);
		return redirect('admin');
	}
	public function student_Bus(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'student_id' => 'required'
		]);
		$collectionReference = $firestore->collection('students');
		$documentReference = $collectionReference->document($request->input('student_id'));
		$snapshot = $documentReference->snapshot();
		$name = $snapshot['name'];
		$class = $snapshot['class'];
		$id=$request->input('student_id');

		$collectionReference1 = $firestore->collection('bus')->documents();
		$busIds=array();
		foreach ($collectionReference1 as $key1) {
			array_push($busIds,$key1->id());
		}
		return view('student_bus',compact('name','class','id','busIds'));
	}
	public function recoveryPassword(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'password' => 'required' ,
			'confirmPassword' => 'required|same:password'
		]);
		$id=$request->input('id');
		$password=$request->input('password');
		$position=$request->input('position');
		$documentParent = $firestore->collection($position)->document($id);
		$documentParent->set([
			'password' => $password
		],['merge'=>true]);
		//return redirect('admin');
	}
	public function forgetPass(Request $request){
		
		$validation = $request->validate([
			'phoneInput' => 'required' ,
			'emailInput' => 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$collectionReference = $firestore->collection('employees');
		$documentReference = $collectionReference->document($request->input('phoneInput'));
		$snapshot = $documentReference->snapshot();
		
		if ($snapshot->exists()) {
			if ($snapshot['email']==$request->input('emailInput')) {
				\Mail::to($request->input('emailInput'))->send(new sendMail($request->input('phoneInput')));
				return redirect('/')->withErrors('Email is sent');
			}else{
				return redirect()->back()->withErrors('Wrong Email or Phone number');
			}
		}else{
			return redirect()->back()->withErrors('Wrong Email or Phone number');
		}
	}
	
	public function accessBus(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'busid' => 'required'
		]);
		$collectionReference = $firestore->collection('bus');
		$documentReference = $collectionReference->document($request->input('busid'));
		$snapshot = $documentReference->snapshot();
		$supervisorName = $snapshot['supervisor name'];
		$supervisorPhoneNumber = $snapshot['supervisor phone'];
		$driverName = $snapshot['driver name'];
		$driverPhoneNumber = $snapshot['driver phone'];
		
		$collection = $firestore->collection('students');
		$query = $collection->where('busnumber', '=',$request->input('busid'));
		$snapshot2 = $query->documents();
		$names=array();
		$classes=array();
		$parentNumbers=array();
		foreach ($snapshot2 as $user){
			array_push($names,$user['name']);
			array_push($classes,$user['class']);
			array_push($parentNumbers,$user['parentPhone']);
		}
		$busIds=$request->input('busIds1');
		return view('busaccess',compact('supervisorName','supervisorPhoneNumber','driverName','driverPhoneNumber','names','classes','busIds','parentNumbers'));
	}
	
	public function accessClass(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'classid' => 'required'
		]);
		
		$collection = $firestore->collection('students');
		$query = $collection->where('class', '=',$request->input('classid'));
		$snapshot2 = $query->documents();
		$names=array();
		$classes=array();
		$parentNumbers=array();
		foreach ($snapshot2 as $user){
			array_push($names,$user['name']);
			array_push($classes,$user['class']);
			array_push($parentNumbers,$user['parentPhone']);
		}
		$collectionReference = $firestore->collection('classrooms')->documents();
		$classIds=array();
		foreach ($collectionReference as $key) {
			$classIds[$key->id()]=$key->fields();
		}
		$classId=$request->input('classIds1');
		return view('classaccess',compact('names','classes','classId','classIds','parentNumbers'));
	}

	public function addSubjectStu(Request $request){
		
		$validation = $request->validate([
			
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		return $request->input('sub');
	}

	public function addpost(Request $request){
		
		$validation = $request->validate([
			'subject'=> 'required',
			'question' => 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('students')->document(session('id'))->collection('questions');
		$documentParent->add([
			'post' => $request->input('question') ,
			'subject' => $request->input('subject') ,
			'date' => date('d-m-Y h:i:s'),
			'name' => session('name'),
			'pic' => session('pic')
		]);
		return redirect('askyourteacher');
	}
	public function deletePost(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentClass = $firestore->collection('students/'.session('id').'/questions')->document($request->input('postId'));
		$documentClass -> delete();
		return redirect('askyourteacher');
	}

	public function addcomment(Request $request){
		
		$validation = $request->validate([
			'comment'=> 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('students')->document(session('id'))->collection('questions')->document($request->input('postId'))->collection('comments');
		$documentParent->add([
			'comment' => $request->input('comment') ,
			'date' => date('d-m-Y h:i:s'),
			'name' => session('name'),
			'id' => session('id'),
			'pic' => session('pic')
		]);
		if (session('position')=='admin') {
			return redirect('answerQuestions');
		}
		return redirect('askyourteacher');
	}
	public function addcommentTeacher(Request $request){
		
		$validation = $request->validate([
			'comment'=> 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$documentParent = $firestore->collection('students')->document($request->input('studentId'))->collection('questions')->document($request->input('postId'))->collection('comments');
		$documentParent->add([
			'comment' => $request->input('comment') ,
			'date' => date('d-m-Y h:i:s'),
			'name' => session('name'),
			'id' => session('id'),
			'pic' => 'data:image/png;base64,'.session('pic')
		]);
		return redirect('answerQuestions');
	}
	public function loadSheets(Request $request){
		
		$validation = $request->validate([
			'subject'=> 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$collection = $firestore->collection('sheets/'.session('classs').'/'.$request->input('subject'))->documents();
		$sheets='No files found';
		
		$collectionReference = $firestore->collection('subjects')->documents();
		$subjectss=array();
		foreach ($collectionReference as $key) {
			$subjectss[$key->id()]=$key->fields();
		}
		
		if (!($collection->isEmpty())) {
			$sheets=array();
			foreach ($collection as $sheet){
				array_push($sheets,$sheet);
			}
		}
		return view('library',compact('sheets','subjectss'));
	}
	public function loadSheetsAdmin(Request $request){
		
		$validation = $request->validate([
			'subject'=> 'required',
			'classess' => 'required'
		]);

		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$collection = $firestore->collection('sheets/'.$request->input('classess').'/'.$request->input('subject'))->documents();
		$sheets='No files found';
		$subjectId=$request->input('subject');
		$classId=$request->input('classess');
		
		if (!($collection->isEmpty())) {
			$sheets=array();
			foreach ($collection as $sheet){
				$sheets[$sheet->id()]=$sheet->fields();
			}
		}
		return view('libraryAdmin',compact('sheets','subjectId','classId'));
	}
	
	public function sheetDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentClass = $firestore->collection('sheets/'.$request->input('classId').'/'.$request->input('subjectId'))->document($request->input('sheetId'));
		$documentClass -> delete();
		return redirect('libraryAdmin');
	}
	public function addClass(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'classroomname' => 'required'
		]);
		$documentClass = $firestore->collection('classrooms');
		$documentClass->add([
			'class' => $request->input('classroomname'),
			'studentsNumber' => 0
		]);
		return redirect('class');
	}
	
	public function classDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentClass = $firestore->collection('classrooms')->document($request->input('id'));
		$documentClass -> delete();
		return redirect('class');
	}
	
	public function addSubject(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'subjectname' => 'required'
		]);
		$documentClass = $firestore->collection('subjects');
		$documentClass->add([
			'subject' => $request->input('subjectname')
		]);
		return redirect('admin');
	}
	
	public function subjectDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentSubject = $firestore->collection('subjects')->document($request->input('id'));
		$documentSubject -> delete();
		return redirect('subject');
	}
	
	public function addLine(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'linename' => 'required'
		]);
		$documentClass = $firestore->collection('lines');
		$documentClass->add([
			'line' => $request->input('linename')
		]);
		return redirect('admin');
	}
	
	public function lineDelete(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentSubject = $firestore->collection('lines')->document($request->input('id'));
		$documentSubject -> delete();
		return redirect('line');
	}
	
	public function assignClassesToTeacher(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'classes' => 'required',
			'subject' => 'required',
			'teacherId' => 'required'
		]);

		$documentSubject = $firestore->collection('employees/'.$request->input('teacherId').'/classes');
		foreach ($request->input('classes') as $value) {
			$documentSubject->document($value)->set([
				'subject' => $request->input('subject')
			]);
		}		
		return redirect('teachersubjectclass');
	}
	
	public function assignSubjectsToClass(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		$validation = $request->validate([
			'subjects' => 'required',
			'class' => 'required'
		]);
		$documentSubject = $firestore->collection('class_sub')->document($request->input('class'));
		$documentSubject->set([
			'subjects' => $request->input('subjects')
		]);
		return redirect('assignsubjects');
	}
	
	public function addNews(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);
		
		$validation = $request->validate([
			'title' => 'required', 
			'content' => 'required',
			'picture' => 'required'
		]);
		$Pic=base64_encode(file_get_contents($request->file('picture')->getPathName()));
		$documentClass = $firestore->collection('news');
		$documentClass->add([
			'title' => $request->input('title'),
			'content' => $request->input('content'),
			'picture' => $Pic
		]);
		return redirect('admin');
	}
	
	public function deleteNews(Request $request){
		$firestore = new FirestoreClient([
			'keyFilePath' => 'import/school-897974d11215.json'
		]);

		$documentSubject = $firestore->collection('news')->document($request->input('id'));
		$documentSubject -> delete();
		return redirect('news');
	}
	
	public function enrollFingerPrint(){
		$process = new Process('C:\Users\hesha\AppData\Local\Programs\Python\Python35-32\python.exe C:/Users/hesha/Desktop/ras/files/enroll_function.py');
		try {
			$process->run();

			echo $process->getOutput();
		} catch (ProcessFailedException $exception) {
			echo $exception->getMessage();
		}	
	}

	public function confirmPassword($user,$pass){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        
        $documentReference = $firestore->collection('parents')->document($user);
        $snapshot = $documentReference->snapshot();
        if (Hash::check($pass, $snapshot['password'])) {
			return response()->json(['confirm' => "correct"]);
		}
		else{
			return response()->json(['confirm' => "Wrong Username OR Password"]);
		}
    }
}