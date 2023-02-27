<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MainController;
use App\Http\Controllers\auth\coustamAuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\userRequestController;
use App\Http\Controllers\Admin\Dashboard\AccountUnableController;
use App\Http\Controllers\Admin\colleges\Collegename;
use App\Http\Controllers\Admin\colleges\Collegecourse;
use App\Http\Controllers\Admin\colleges\CollegeDept;
use App\Http\Controllers\Admin\colleges\CollegePosition;
use App\Http\Controllers\Admin\CollegeTemplate\CollegeTemplate;
use App\Http\Middleware\Adminaccess;
use App\Http\Middleware\StudentsProfile;
use App\Http\Controllers\Public\Profile;
use App\Http\Controllers\Public\StudentProfile;
use App\Http\Controllers\Public\AlumniProfile;
use App\Http\Controllers\Public\StaffProfile;
use App\Http\Controllers\Public\SponsorProfile;
use App\Http\Controllers\Public\Pages\Pagescontroller;
use App\Http\Controllers\Public\CollegePage\collegepage;
use App\Http\Controllers\Public\CollegePage\joinPages;
use App\Http\Controllers\Public\GroupsController;
use App\Http\Controllers\Public\Events\EventController;
use App\Http\Controllers\Public\projectscontroller;
use App\Http\Controllers\Public\Home\StaffOfTheWeekController;
use App\Http\Controllers\Public\Home\StudentOfTheWeekController;
use App\Http\Controllers\Public\AddFriends\AddFriendsController;
use App\Http\Controllers\Public\NewsFeed\NewsFeedController;
use App\Http\Controllers\Public\Chatmsg\ChatMsgController;
use App\Http\Controllers\Public\Notification\NotificationController;
use App\Http\Controllers\Public\Stories\StoriesController;
use App\Http\Controllers\Public\chatmessage;

use App\Http\Controllers\Public\Calendar\CalendarController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/admin', function () {
//     return view('Admin.index');
// });
// Admin Routes
Route::get('/admindash/dashboard',[DashboardController::class, 'index'])->middleware(Adminaccess::class);
Route::get('/admindash/dashboard/userrequests',[DashboardController::class, 'userrequests'])->middleware(Adminaccess::class);
Route::post('/admindash/dashboard/response',[userRequestController::class,'userrequestsresponse']);
Route::get('/admindash/users',[DashboardController::class,'Users'])->middleware(Adminaccess::class);
Route::post('/admindash/users/update',[DashboardController::class,'update'])->middleware(Adminaccess::class);
Route::get('/admindash/dashboard/unable-request',[AccountUnableController::class, 'index'])->middleware(Adminaccess::class);
Route::get('/activeAccount',[AccountUnableController::class, 'activeAccount'])->middleware(Adminaccess::class);
// College
Route::get('admindash/Colleges', function () {
    return view('Admin.Colleges.index');
})->middleware(Adminaccess::class);
// College Name Route
Route::get('admindash/Colleges/name',[Collegename::class, 'index'])->middleware(Adminaccess::class);
Route::POST('admindash/Colleges/addcolleges',[Collegename::class, 'Addcolleges'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/delete',[Collegename::class,'Deletecolleges'])->middleware(Adminaccess::class);
Route::get('admindash/Colleges/collegemember/{id}',[Collegename::class, 'collegemembers'])->middleware(Adminaccess::class);

//courses
Route::get('admindash/Colleges/Courses',[Collegecourse::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Addcourses',[Collegecourse::class,'Addcourses'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deletecourse',[Collegecourse::class,'deletecourses'])->middleware(Adminaccess::class);

// Dept
Route::get('admindash/Colleges/Dept',[CollegeDept::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Adddept',[CollegeDept::class,'Adddept'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deletedept',[CollegeDept::class,'deletedept'])->middleware(Adminaccess::class);

//Position 
Route::get('admindash/Colleges/Position',[CollegePosition::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Addposition',[CollegePosition::class,'Addposition'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deleteposition',[CollegePosition::class,'deleteposition'])->middleware(Adminaccess::class);

// College Template route
Route::get('admindash/Colleges/createTemplate/',[CollegeTemplate::class,'create']);
Route::get('admindash/Colleges/getModerator/',[CollegeTemplate::class,'getModerator']);
// Route::get('admindash/Colleges/createTemplate/{id}',[CollegeTemplate::class,'index']);
Route::post('admindash/Colleges/createTemplate',[CollegeTemplate::class,'createTemplate']);


Route::get('/',[MainController::class, 'index']);
Route::get('/home',[MainController::class, 'home']);

Route::get('/register', [MainController::class, 'register']);
Route::get('/saveregister', [coustamAuthController::class, 'register']);

Route::get('/login', [MainController::class, 'login']);
Route::get('/userlogin',[coustamAuthController::class, 'login']);

Route::get('/disabled-account/{username}', [MainController::class, 'disabledaccount']);
Route::get('/requnableaccount',[coustamAuthController::class, 'requnableaccount']);

Route::get('/logout', [coustamAuthController::class, 'logout']);
// Routes for Groups
Route::get('/groups', [GroupsController::class, 'index']);
Route::get('/addGroup', [GroupsController::class, 'addGroup']);
Route::get('/sendMessage', [GroupsController::class, 'sendMessage']);
Route::get('/deletegrp', [GroupsController::class, 'deletegrp']);
Route::get('/addGrpUser', [GroupsController::class, 'addGrpUser']);
Route::get('/addgrpmember', [GroupsController::class, 'addgrpmember']);
Route::get('/newmembers', [GroupsController::class, 'newmembers']);


// Profile dashboard
Route::get('/my-account',[Profile::class, 'index']);
//Student Profile 
Route::get('/student/{username}',[StudentProfile::class, 'index'])->middleware(StudentsProfile::class);
Route::POST('/studentprofile/save',[StudentProfile::class, 'save'])->middleware(StudentsProfile::class);
Route::post('/studentprofile/upload',[StudentProfile::class, 'profilepicture'])->middleware(StudentsProfile::class);
Route::get('/studentprofile/getCoursesByCollege',[StudentProfile::class, 'getCoursesByCollege'])->middleware(StudentsProfile::class);
// Route::get('/trycode',[StudentProfile::class, 'trycode']);


// Alumni Profile
Route::get('/alumni/{username}',[AlumniProfile::class, 'index']);
Route::POST('/alumniprofile/save',[AlumniProfile::class, 'save']);
Route::post('/alumniprofile/upload',[AlumniProfile::class, 'profilepicture']);


//Sponsorprofile
Route::get('/sponsor/{username}',[SponsorProfile::class,'index']);
Route::post('/Sponsor/profile/upload',[SponsorProfile::class,'profilephoto']);
Route::post('/Sponsor/profile/Sponsordata',[SponsorProfile::class,'AddSponsorData']);

//Staffprofile
Route::get('/staff/{username}',[StaffProfile::class,'index']);
Route::post('/Staff/profile/upload',[StaffProfile::class,'profilephoto']);
Route::post('/Staff/profile/insert',[StaffProfile::class,'AddStaffData']);
Route::post('/Staff/profile/collegedata',[StaffProfile::class,'getcollegedata']);
Route::get('home/pages',[Pagescontroller::class,'index']);
Route::post('home/pages/addPagesdata',[Pagescontroller::class,'AddPagedata']);


// try Route

// Route::get('/home/trycode/', function (){
//     Artisan::call('make:model login_detail -m');
// });
// Route::get('/home/collegePage',[collegepage::class, 'index']);

//College pages
// Route::get('/collegePages',[CollegePages::class,'index']);
// Route::get('/collegePages', function () {
//     return view('Public.Home.CollegePages.index');
// });
Route::get('/collegePages',[collegepage::class, 'index']);
Route::get('/collegePages/{id}',[collegepage::class, 'SinglePage']);

Route::post('/addposts',[collegepage::class,'addPost']);
Route::get('/deletepost',[collegepage::class,'deletePost']);
// Join page 
// Route::get('/joinPage',[collegepage::class,'joinPage']);
Route::get('/joinPage',[joinPages::class,'joinPage']);

Route::get('/joinPageIndex',[joinPages::class,'index']);
// Route::get('/collegepages',[CollegePages::class,'index']);



// Events Routes

Route::get('/events',[EventController::class, 'index']);
Route::get('/createevent',[EventController::class, 'createevent']);
Route::post('/saveevent',[EventController::class, 'saveevent']);
Route::get('/eventrequests',[EventController::class, 'eventrequests']);
Route::get('/acceptevent',[EventController::class, 'acceptevent']);
Route::get('/declineevent',[EventController::class, 'declineevent']);
Route::post('/sponsorrequest',[EventController::class, 'sponsorrequest']);
Route::post('/getsponsorid',[EventController::class, 'Getsponsorshipid']);
Route::get('/events/myevents',[EventController::class, 'myevents']);
Route::post('/sponsorrequests',[EventController::class, 'SponsorRequests']);
Route::get('/sponsorrequests/accepted/{id?}',[EventController::class, 'SponsorRequestaccepted']);
Route::get('/sponsorrequests/denied{id?}',[EventController::class, 'SponsorRequestdenied']);



//projectgroups

Route::get('/projectgroups/{id?}',[projectscontroller::class,'index']);
Route::get('projects/{id?}',[projectscontroller::class,'projectgroups']);
Route::post('addprojects',[projectscontroller::class,'addprojectgroups']);
Route::post('deleteproject',[projectscontroller::class,'delete']);
Route::post('projectsmessage',[projectscontroller::class,'sendmessage']);




// VOTE ROUTES  
// ::: Student of the week
Route::get('/studentoftheweek',[StudentOfTheWeekController::class, 'index']);
Route::post('/nominatestudent',[StudentOfTheWeekController::class, 'save']);
Route::get('/getstudentoftheweek',[StudentOfTheWeekController::class, 'getstudentoftheweek']);
// Route::get('/try',[StudentOfTheWeekController::class, 'trycode']);

// ::: Staff of the week
Route::get('/staffoftheweek',[StaffOfTheWeekController::class, 'index']);
Route::post('/nominatestaff',[StaffOfTheWeekController::class, 'save']);
Route::get('/getstaffoftheweek',[StaffOfTheWeekController::class, 'getstaffoftheweek']);
// Route::get('/try',[StaffOfTheWeekController::class, 'trycode']);



/* Route For User Add Friends */

Route::get('/addfriends',[AddFriendsController::class, 'index']);
Route::get('/userimage',[AddFriendsController::class, 'userimage']);
Route::get('/followuser',[AddFriendsController::class, 'follow']);
Route::get('/try',[AddFriendsController::class, 'trycode']);


/* Routes for News Feed **/
Route::get('/newsfeed',[NewsFeedController::class, 'index']);
Route::post('/uploadpost',[NewsFeedController::class, 'uploadpost']);
Route::get('/usersdata',[NewsFeedController::class, 'userimage']);
/* Routes for News Feed Like Post **/
Route::get('/likepost',[NewsFeedController::class, 'likepost']);
Route::get('/checklikes',[NewsFeedController::class, 'checklikes']);
/* Routes for News Feed Comment Post  **/
Route::get('/commentpost',[NewsFeedController::class, 'commentpost']);
Route::get('/comments',[NewsFeedController::class, 'comments']);
Route::get('/countcomments',[NewsFeedController::class, 'countcomments']);

/* Routes for chatmsg **/
Route::get('/chatmsg/{id?}',[ChatMsgController::class, 'index']);
Route::post('/sendmsg',[ChatMsgController::class,'sendmessage']);


/* Notification Route   **/
Route::get('/notification',[NotificationController::class, 'index']);
Route::get('/markasread',[NotificationController::class, 'markasread']);

Route::get('/allnotifications',[NotificationController::class, 'allnotifications']);
Route::get('/markread',[NotificationController::class, 'markread']);


// Route For Upload Stories
Route::post('/uploadstory',[StoriesController::class, 'index']);



//tryyashwant
Route::any('/trycode',[projectscontroller::class,'trycode']);


// calendar Routes
Route::get('/calendar',[CalendarController::class, 'index']);

//Unique user name 
Route::get('/unique-username',[MainController::class, 'uniqueusername']);