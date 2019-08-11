<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Mapper;

class pagesView extends Controller
{
	
    public function admin(){
		return view('admin');
	}
	public function teacher(){
		return view('teacher');
	}
	
	public function attendance(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
		return view('attendance',compact('classess'));
	}
	public function bus_add(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
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
		return view('bus_add',compact('driverIds','driverNames','supervisorIds','supervisorNames','liness'));
	}
    public function bus_delete(){
        return view('bus_delete');
    }
	
    public function bus_update(){
        return view('bus_update');
    }
	public function buses_coords() {
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('bus')->documents();
		$coordinates = [];
		
		foreach ($collectionReference as $key) 
		{
		    $coordinates[] = [
		        'id' => $key->id(),
		        'lat' => $key->fields()['lat'],
    		    'long' => $key->fields()['long'],
                'line' => $key->fields()['line'],
                'driverName' => $key->fields()['driver name'],
                'supervisorName' => $key->fields()['supervisor name'],
                'supervisorPhone' => $key->fields()['supervisor phone']
		    ];
        }
        return response()->json(['data' => $coordinates]);
    }
    
    public function bus_coords() {
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collection1 = $firestore->collection('parents')->document(session('id'))->snapshot();
		$collection2 = $firestore->collection('students');
		$collection3 = $firestore->collection('bus');
		$busId=array();
		$coordinates = [];
        foreach ($collection1['children'] as $key => $value)
		{
            $snapshot=$collection2->document($key)->snapshot();
            array_push($busId,$snapshot['busnumber']);
        }
        array_unique($busId);
        foreach ($busId as $key) 
		{
			$currentBus = $collection3->document($key)->snapshot();
			$coordinates[] = [
		        'id' => $currentBus->id(),
		        'lat' => $currentBus->fields()['lat'],
    		    'long' => $currentBus->fields()['long'],
                'line' => $currentBus->fields()['line'],
                'driverName' => $currentBus->fields()['driver name'],
                'supervisorName' => $currentBus->fields()['supervisor name'],
                'supervisorPhone' => $currentBus->fields()['supervisor phone']
		    ];
        }
		
		return response()->json(['data' => $coordinates]);
    }
	
    public function bustracking(){
		
        return view('bustracking');
    }
	
	public function bustrackingparent(){
		
        return view('bustrackingParent');
    }
	
	public function employee(){
    	return view('employee');
    }
    public function sheets(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
		$collectionReference2 = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference2 as $key2) {
            $subjectss[$key2->id()]=$key2->fields();
        }
		
    	return view('uploadsheet',compact('classess','subjectss'));
    }
    public function grades(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
		$collectionReference2 = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference2 as $key2) {
            $subjectss[$key2->id()]=$key2->fields();
        }
		
    	return view('grades',compact('classess','subjectss'));
    }
    public function index(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('news')->documents();
        $newss=array();
        foreach ($collectionReference as $key) {
            $newss[$key->id()]=$key->fields();
        }
        return view('homepage',compact('newss'));
    }
    public function notification(){
    	return view('sendnotification');
    }
    public function parent(){
    	return view('parent');
    }
    public function profile(){
    	return view('profile');
    }
    public function studentAccess(){
    	return view('studentaccess');
    }
	public function busAccess(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('bus')->documents();
        $busIds=array();
        foreach ($collectionReference as $key) {
            array_push($busIds,$key->id());
        }
        return view('busaccess',compact('busIds'));
    }
	public function classAccess(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('classrooms')->documents();
        $classIds=array();
        foreach ($collectionReference as $key) {
            $classIds[$key->id()]=$key->fields();
        }
		
        return view('classaccess',compact('classIds'));
    }
    public function student(){
    	$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        $collection = $firestore->collection('students');
        $query = $collection->orderBy('added_at', 'DESC')->limit(1);;
        $snapshot = $query->documents();
        $studentId=null;
		
        foreach ($snapshot as $user){
            $studentId=$user->id();
        }
        $studentId = ((int)$studentId) +1;
        if (substr(date('Y'),2,4)>substr($studentId,0,2)) {
            $studentId=substr(date('Y'),2,4)."0001";
        }
		
		$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
        return view('student',compact('studentId','classess'));
    }
    public function timetable(){	
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
    	return view('uploadtimetable',compact('classess'));
    }
	public function updateemployee(){
    	return view('employeeupdate');
    }
	public function updateparent(){
    	return view('parentupdate');
    }
	public function updatestudent(){
    	return view('studentupdate');
    }
	public function deleteemployee(){
    	return view('employeedelete');
    }
	public function deleteparent(){
    	return view('parentdelete');
    }
	public function deletestudent(){
    	return view('studentdelete');
    }
    public function assignbus(){
        return view('student_bus');
    }
    public function recoveryPassword($position,$id){
        return view('recoveryPassword',compact('id','position'));
    }
    public function forgetPassword(){
        return view('forgetPassword');
    }
    public function mailContent(){
        return view('mailContent');
    }
    public function subjectstudent(){
        return view('subjectstudent');
    }
    public function studentInterface(){
        return view('studentInterface');
    }
	public function library(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		$collectionReference = $firestore->collection('students/'.session('id').'/subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference as $key) {
            $subjectss[$key->id()]=$key->fields();
        }
        return view('library',compact('subjectss'));
    }
    public function libraryAdmin(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        $collectionReference = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference as $key) {
            $subjectss[$key->id()]=$key->fields();
        }
        $collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
        return view('libraryAdmin',compact('subjectss','classess'));
    }
	public function subject(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference as $key) {
            $subjectss[$key->id()]=$key->fields();
        }
        return view('subject',compact('subjectss'));
    }
	public function line(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('lines')->documents();
        $liness=array();
        foreach ($collectionReference as $key) {
            $liness[$key->id()]=$key->fields();
        }
        return view('line',compact('liness'));
    }
	public function class(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
        return view('class',compact('classess'));
    }
	
    public function updateStudentPassword(){
        return view('updateStudentPassword');
    }

	public function assignsubjects(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
		
		$collectionReference2 = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference2 as $key2) {
            $subjectss[$key2->id()]=$key2->fields();
        }
        return view('assign_subjects',compact('classess','subjectss'));
    }
	
	public function teachersubjectclass(){
		$firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
		
		
		$collectionReference2 = $firestore->collection('subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference2 as $key2) {
            $subjectss[$key2->id()]=$key2->fields();
        }
        return view('teacher_subject_class',compact('classess','subjectss'));
    }

    public function studentProfile($id){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        
        $collectionReference = $firestore->collection('students');
        $documentReference = $collectionReference->document($id);
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
        session(['pic' => $pic]);/*picccccccc*/
        $supername='';
        $superphone='';
        $timetablepic='';
        $snapshot2 = $firestore->collection('timetables')->document($class)->snapshot();
        $timetablepic = 'data:image/png;base64,'.$snapshot2['pic'];
        if($bus){
            $collectionReference2 = $firestore->collection('bus');
            $documentReference2 = $collectionReference2->document($bus);
            $snapshot2 = $documentReference2->snapshot();
            $supername = $snapshot2['supervisor name'];
            $superphone = $snapshot2['supervisor phone'];
        }
        return view('studentinterface',compact('name','class','bus','supername','superphone','subjects','attendance','parentPhone','pic','timetablepic'));
    }

    public function askyourteacher(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        $collection = $firestore->collection('students')->document(session('id'))->collection('questions');
        $snapshot = $collection->documents();
        if (!($snapshot->isEmpty())) {
            $post2=array();
            $comments=array();
            foreach ($snapshot as $user){
                $post2[$user->id()]['posts']=$user->fields();
                $commentsRef = $firestore->collection('students')->document(session('id'))->collection('questions')->document($user->id())->collection('comments')->orderBy('date', 'DESC')->documents();
                if (!($commentsRef->isEmpty())) {
                    foreach ($commentsRef as $comment) {
                        array_push($comments,$comment->fields());
                    }
                    $post2[$user->id()]['comments']=$comments;
                    $comments=array();
                }
            }
        }
		$collectionReference2 = $firestore->collection('students/'.session('id').'/subjects')->documents();
        $subjectss=array();
        foreach ($collectionReference2 as $key2) {
            $subjectss[$key2->id()]=$key2->fields();
        }
        
        // return $post2;
        return view('askyourteacher',compact('post2','subjectss'));
    }
    public function answerQuestions(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        $collectionReference = $firestore->collection('classrooms')->documents();
        $classess=array();
        foreach ($collectionReference as $key) {
            $classess[$key->id()]=$key->fields();
        }
        $collectionReference = $firestore->collection('employees')->document(session('id'))->snapshot();
        $pic=$collectionReference['pic'];
        $name=$collectionReference['name'];
        $dateofbirth=$collectionReference['dateofbirth'];
        $email=$collectionReference['email'];

        $collection = $firestore->collection('employees/'.session('id').'/classes');
        $classes = $collection->documents();
        
        if (!($classes->isEmpty())) {
            foreach ($classes as $classValue) {                
                $collection = $firestore->collection('students')->where('class', '=', $classValue->id());;
                $students = $collection->documents();
                if (!($students->isEmpty())) {
                    foreach ($students as $student) {
                        $posts = $firestore->collection('students')->document($student->id())->collection('questions')->where('subject', '=', $classValue['subject'])->documents();
                        if (!($posts->isEmpty())) {
                            $post2=array();
                            $comments=array();
                            foreach ($posts as $user){
                                $post2[$user->id()]['posts']=$user->fields();
                                $post2[$user->id()]['studentId']=$student->id();
                                $commentsRef = $firestore->collection('students')->document($student->id())->collection('questions')->document($user->id())->collection('comments')->orderBy('date', 'DESC')->documents();
                                if (!($commentsRef->isEmpty())) {
                                    foreach ($commentsRef as $comment) {
                                        array_push($comments,$comment->fields());
                                    }
                                    $post2[$user->id()]['comments']=$comments;
                                    $comments=array();
                                }
                            }
                        }
                    }
                }
            }
        }
        return view('answerQuestions2',compact('post2','classess','pic','name','email','dateofbirth'));
    }

    public function parentPanel(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
        $snapshot = $firestore->collection('parents')->document(session('id'))->snapshot();
        $children=$snapshot['children'];
        
        return view('parentPanel',compact('children'));
    }
	
	public function news(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
    	$collectionReference = $firestore->collection('news')->documents();
        $newss=array();
        foreach ($collectionReference as $key) {
            $newss[$key->id()]=$key->fields();
        }
        return view('news',compact('newss'));
    }
	
	public function homepage(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('news')->documents();
        $newss=array();
        foreach ($collectionReference as $key) {
            $newss[$key->id()]=$key->fields();
        }
        return view('homepage',compact('newss'));
    }
	
	public function slider(){
        $firestore = new FirestoreClient([
            'keyFilePath' => 'import/school-897974d11215.json'
        ]);
		
		$collectionReference = $firestore->collection('news')->documents();
        $newss=array();
        foreach ($collectionReference as $key) {
            $newss[$key->id()]=$key->fields();
        }
        return view('slider',compact('newss'));
    }
}