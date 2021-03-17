<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'superadmin/superadmin_controller/login';
$route['member'] = 'user/member_controller';
$route['partener'] = 'user/partener_controller/login';
$route['admin/login_validation'] = 'superadmin/superadmin_controller/validate_login_data';
$route['admin/employee_information'] = 'superadmin/superadmin_controller/employee_information';
//==================Front================================================
$route['front/gallery/gallery_data'] = 'front/front_controller/gallery';
$route['front/gallery/gallery_photos'] = 'front/front_controller/gallery_photos';
$route['front/gallery/gallery_videos'] = 'front/front_controller/gallery_videos';
$route['front/about_us'] = 'front/front_controller/about_us';
$route['front/Events'] = 'front/front_controller/Events';
$route['front/Contact_us'] = 'front/front_controller/Contact_us';

// $route['Home/(:any)'] = 'Home/home';



//===============Admin information===================================================================

$route['admin/logout'] = 'superadmin/superadmin_controller/logout';
$route['admin/change_password'] = 'superadmin/superadmin_controller/change_password';
$route['admin/admin_change_password'] = 'superadmin/superadmin_controller/admin_change_password';


//================users information======================================================

$route['admin/users/user_information'] = 'superadmin/users_controller/user_information';
$route['admin/users/user_information/(:any)'] = 'superadmin/users_controller/user_information';
$route['admin/users/search'] = 'superadmin/users_controller/search';
$route['admin/users/search/(:any)'] = 'superadmin/users_controller/search';
$route['admin/users/update_user/(:any)/(:any)'] = 'superadmin/users_controller/update_user';
$route['admin/users/update_user/(:any)/(:any)/(:any)'] = 'superadmin/users_controller/update_user';
$route['admin/users/delete_user/(:any)'] = 'superadmin/users_controller/delete_user';
$route['admin/users/delete_user/(:any)/(:any)'] = 'superadmin/users_controller/delete_user';
$route['admin/users/insert_user'] = 'superadmin/users_controller/insert_user';
$route['admin/users/add'] = 'superadmin/users_controller/add';
$route['admin/users/update/(:any)/(:any)'] = 'superadmin/users_controller/display_single';
$route['admin/users/update_user/(:any)'] = 'superadmin/users_controller/update_single_user';
$route['admin/users/update_user/(:any)/(:any)'] = 'superadmin/users_controller/update_single_user';
$route['admin/users/import_users_data'] = 'superadmin/import_users_controller/index';
$route['admin/users/users_uploadData'] = 'superadmin/import_users_controller/uploadData';

//================ Gallery information======================================================

$route['admin/gallery/add'] = 'superadmin/Upload_Files/gallery';
$route['admin/gallery/gallery_information/(:any)'] = 'superadmin/Upload_Files/gallery_information';
$route['admin/gallery/gallery_information'] = 'superadmin/Upload_Files/gallery_information';
$route['admin/gallery/search'] = 'superadmin/Upload_Files/search';
$route['admin/gallery/search/(:any)'] = 'superadmin/Upload_Files/search';
$route['admin/gallery/update_status/(:num)'] = 'superadmin/Upload_Files/update_status';
$route['admin/gallery/update_status/(:num)/(:num)'] = 'superadmin/Upload_Files/update_status';
$route['admin/gallery/update_status/(:num)/(:num)/(:num)'] = 'superadmin/Upload_Files/update_status';
$route['admin/gallery/delete_gallery/(:num)'] = 'superadmin/Upload_Files/delete_gallery';
$route['admin/gallery/delete_gallery/(:num)/(:num)'] = 'superadmin/Upload_Files/delete_gallery';
$route['admin/gallery/update_gallery_data/(:num)'] = 'superadmin/Upload_Files/update_gallery_data';
$route['admin/gallery/update_gallery_data/(:num)/(:num)'] = 'superadmin/Upload_Files/update_gallery_data';
$route['admin/gallery/update_gallery_data/(:num)/(:num)/(:num)'] = 'superadmin/Upload_Files/update_gallery_data';

//================ Gallery videos information======================================================

 $route['admin/gallery/videos'] = 'superadmin/upload_videos/videos';
 $route['admin/videos/manage_videos/(:any)'] = 'superadmin/upload_videos/manage_videos';
 $route['admin/videos/manage_videos'] = 'superadmin/upload_videos/manage_videos';
$route['admin/videos/search'] = 'superadmin/upload_videos/search';
$route['admin/videos/search/(:any)'] = 'superadmin/upload_videos/search';
$route['admin/videos/update/(:num)'] = 'superadmin/upload_videos/update';
$route['admin/videos/update/(:num)/(:num)'] = 'superadmin/upload_videos/update';
$route['admin/videos/update_videos/(:num)/(:num)'] = 'superadmin/upload_videos/update_videos';
$route['admin/videos/update_videos/(:num)/(:num)/(:num)'] = 'superadmin/upload_videos/update_videos';

//================Navigator======================================================
$route['admin/headings/manage_headings'] = 'superadmin/heading_controller/manage_headings';
$route['admin/headings/manage_headings/(:any)'] = 'superadmin/heading_controller/manage_headings';
$route['admin/headings/insert_heading'] = 'superadmin/heading_controller/insert_heading';
$route['admin/headings/add_heading'] = 'superadmin/heading_controller/add_heading';
$route['admin/headings/update/(:any)/(:any)'] = 'superadmin/heading_controller/display_title';
$route['admin/headings/update_title/(:any)'] = 'superadmin/heading_controller/update_title';
$route['admin/headings/update_title/(:any)/(:any)'] = 'superadmin/heading_controller/update_title';
$route['admin/headings/search'] = 'superadmin/heading_controller/search';
$route['admin/headings/search/(:any)'] = 'superadmin/heading_controller/search';

//================Groups information======================================================

$route['admin/groups/group_information'] = 'superadmin/groups_controller/group_information';
$route['admin/groups/group_information/(:any)'] = 'superadmin/groups_controller/group_information';
$route['admin/groups/search'] = 'superadmin/groups_controller/search';
$route['admin/groups/search/(:any)'] = 'superadmin/groups_controller/search';
$route['admin/groups/update_group/(:num)/(:num)'] = 'superadmin/groups_controller/update_group/';
$route['admin/groups/update_group/(:num)/(:num)/(:num)'] = 'superadmin/groups_controller/update_group';
$route['admin/groups/delete_group/(:num)'] = 'superadmin/groups_controller/delete_group';
$route['admin/groups/delete_group/(:num)/(:num)'] = 'superadmin/groups_controller/delete_group';
$route['admin/users/insert_user'] = 'superadmin/users_controller/insert_user';
$route['admin/users/add'] = 'superadmin/users_controller/add';
$route['admin/groups/update/(:num)/(:num)'] = 'superadmin/groups_controller/display_single';
$route['admin/users/update_user/(:num)'] = 'superadmin/users_controller/update_single_user';
$route['admin/users/update_user/(:num)/(:num)'] = 'superadmin/users_controller/update_single_user';
$route['admin/groups/import_groups_data'] = 'superadmin/import_groups_controller/index';
$route['admin/groups/group_uploadData'] = 'superadmin/import_groups_controller/uploadData';

//=================================Mocktest information===================================================

$route['admin/mocktest/add_mocktest'] = 'superadmin/mocktest_controller/add_mocktest';
$route['admin/mocktest/insert_mocktest'] = 'superadmin/mocktest_controller/insert_mocktest';
$route['admin/mocktest/mocktest_information'] = 'superadmin/mocktest_controller/mocktest_information';
$route['admin/mocktest/mocktest_information/(:any)'] = 'superadmin/mocktest_controller/mocktest_information';
$route['admin/mocktest/search'] = 'superadmin/mocktest_controller/search';
$route['admin/mocktest/search/(:any)'] = 'superadmin/mocktest_controller/search';
$route['admin/mocktest/delete_mocktest/(:num)'] = 'superadmin/mocktest_controller/delete_mocktest';
$route['admin/mocktest/delete_mocktest/(:num)/(:num)'] = 'superadmin/mocktest_controller/delete_mocktest';
$route['admin/mocktest/update/(:num)/(:num)'] = 'superadmin/mocktest_controller/display_mocktest';
$route['admin/mocktest/update_mocktests/(:num)'] = 'superadmin/mocktest_controller/update_mocktests';
$route['admin/mocktest/update_mocktests/(:num)/(:num)'] = 'superadmin/mocktest_controller/update_mocktests';
$route['admin/groups/import_groups_data'] = 'superadmin/import_groups_controller/index';
$route['admin/groups/group_uploadData'] = 'superadmin/import_groups_controller/uploadData';
$route['admin/mocktest/import_mocktest_data'] = 'superadmin/import_mocktest_controller/index';
$route['admin/mocktest/mocktest_uploadData'] = 'superadmin/import_mocktest_controller/uploadData';


//================Memberes information======================================================

$route['admin/members/members_information'] = 'superadmin/members_controller/members_information';
$route['admin/members/members_information/(:any)'] = 'superadmin/members_controller/members_information';
$route['admin/members/search'] = 'superadmin/members_controller/search';
$route['admin/members/search/(:any)'] = 'superadmin/members_controller/search';

$route['admin/members/search_members'] = 'superadmin/members_controller/search_members';
$route['admin/members/search_members/(:any)'] = 'superadmin/members_controller/search_members';
$route['admin/members/search_members/(:any)/(:any)'] = 'superadmin/members_controller/search_members';

$route['admin/members/update_member/(:num)/(:num)'] = 'superadmin/members_controller/update_member/';
$route['admin/members/update_member/(:num)/(:num)/(:num)'] = 'superadmin/members_controller/update_member';
$route['admin/members/update_specific_member/(:num)/(:num)'] = 'superadmin/members_controller/update_specific_member/';
$route['admin/members/update_specific_member/(:num)/(:num)/(:num)'] = 'superadmin/members_controller/update_specific_member';
$route['admin/members/delete_member/(:num)'] = 'superadmin/members_controller/delete_member';
$route['admin/members/delete_member/(:num)/(:num)'] = 'superadmin/members_controller/delete_member';
$route['admin/members/delete_specific_member/(:num)/(:num)'] = 'superadmin/members_controller/delete_specific_member/';
$route['admin/members/delete_specific_member/(:num)/(:num)/(:num)'] = 'superadmin/members_controller/delete_specific_member';
$route['admin/members/update/(:num)/(:num)'] = 'superadmin/members_controller/display_single';
$route['admin/members/update_member/(:num)'] = 'superadmin/members_controller/update_single_member';
$route['admin/members/update_member/(:num)/(:num)'] = 'superadmin/members_controller/update_single_member';

$route['admin/members/members_record'] = 'superadmin/members_controller/members_record';
$route['admin/members/members_record/(:any)'] = 'superadmin/members_controller/members_record';
$route['admin/members/members_record/(:any)/(:any)'] = 'superadmin/members_controller/members_record';


//==========Posts information=======================================================================

$route['admin/posts/posts_information'] = 'superadmin/posts_controller/posts_information';
$route['admin/posts/posts_information/(:any)'] = 'superadmin/posts_controller/posts_information';

$route['admin/posts/comments'] = 'superadmin/posts_controller/comments';
$route['admin/posts/comments/(:num)'] = 'superadmin/posts_controller/comments';

$route['admin/posts/comments_replies'] = 'superadmin/posts_controller/comments_replies';
$route['admin/posts/comments_replies/(:num)'] = 'superadmin/posts_controller/comments_replies';

$route['admin/posts/search'] = 'superadmin/posts_controller/search';
$route['admin/posts/search/(:any)'] = 'superadmin/posts_controller/search';

$route['admin/posts/search_comments'] = 'superadmin/posts_controller/search_comments';
$route['admin/posts/search_comments/(:any)'] = 'superadmin/posts_controller/search_comments';

$route['admin/posts/search_replies'] = 'superadmin/posts_controller/search_replies';
$route['admin/posts/search_replies/(:any)'] = 'superadmin/posts_controller/search_replies';

$route['admin/posts/update_post/(:num)/(:num)'] = 'superadmin/posts_controller/update_post/';
$route['admin/posts/update_post/(:num)/(:num)/(:num)'] = 'superadmin/posts_controller/update_post';

$route['admin/posts/update_comment/(:num)/(:num)'] = 'superadmin/posts_controller/update_comment';
$route['admin/posts/update_comment/(:num)/(:num)/(:num)'] = 'superadmin/posts_controller/update_comment';

$route['admin/posts/update_reply/(:num)/(:num)'] = 'superadmin/posts_controller/update_reply';
$route['admin/posts/update_reply/(:num)/(:num)/(:num)'] = 'superadmin/posts_controller/update_reply';

$route['admin/posts/delete_post/(:num)'] = 'superadmin/posts_controller/delete_post';
$route['admin/posts/delete_post/(:num)/(:num)'] = 'superadmin/posts_controller/delete_post';

$route['admin/posts/delete_reply/(:num)/(:num)'] = 'superadmin/posts_controller/delete_reply';
$route['admin/posts/delete_reply/(:num)/(:num)/(:num)'] = 'superadmin/posts_controller/delete_reply';

$route['admin/posts/delete_comments/(:num)'] = 'superadmin/posts_controller/delete_comments';
$route['admin/posts/delete_comments/(:num)/(:num)'] = 'superadmin/posts_controller/delete_comments';


//===========================Message routing=========================================================

$route['admin/messages/messages_information'] = 'superadmin/messages_controller/messages_information';
$route['admin/messages/messages_information/(:any)'] = 'superadmin/messages_controller/messages_information';
$route['admin/messages/search'] = 'superadmin/messages_controller/search';
$route['admin/messages/search/(:any)'] = 'superadmin/messages_controller/search';
$route['admin/messages/delete_message/(:num)'] = 'superadmin/messages_controller/delete_message';
$route['admin/messages/delete_message/(:num)/(:num)'] = 'superadmin/messages_controller/delete_message';
$route['admin/messages/update_message/(:num)/(:num)'] = 'superadmin/messages_controller/update_message';
$route['admin/messages/update_message/(:num)/(:num)/(:num)'] = 'superadmin/messages_controller/update_message';

//============================Dashboard Information====================

$route['admin/dashboard'] = 'superadmin/dashboard_controller/index';


//============================Updated from Nov2020====================
$route['select_state'] = 'welcome/select_state';
$route['app_state'] = 'welcome/app_state';

//===============================IRSC Members / Partners======================================
$route['admin/irsc_members/irsc_members_information'] = 'superadmin/members/irsc_members_information';
$route['admin/irsc_partners/irsc_partners_information'] = 'superadmin/parteners/irsc_partners_information';