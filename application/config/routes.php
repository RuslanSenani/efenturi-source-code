<?php
defined('BASEPATH') or exit('No direct script access allowed');

//admin routes
$route['correct-admin']                         = 'admin/account/login_form';

//front routes
$route['default_controller']                    = 'home';
$route['404_override']                          = 'home/not_found';
$route['translate_uri_dashes']                  = FALSE;
$route['admin/(.+)']                            = 'admin/$1';
$route['sitemap.xml']                           = 'sitemap/index';
$route['send-message']                          = 'home/send_message';

//
// $route['login']                                 = 'users/login';
// $route['login/submit']                          = 'users/login_submit';

// $route['register']                              = 'users/register';
// $route['register/submit']                       = 'users/register_submit';

// $route['logout']                                = 'users/logout';

// $route['delete/user/(.+)']                      = 'users/delete_user/$1';
// $route['edit/user']                             = 'users/edit_user';


$route['verification/(.+)/(.+)']                = 'users/verification/$1/$2';

$route['forgot-password']                       = 'users/forgot_password';
$route['forgot-password/submit']                = 'users/forgot_password_submit';

$route['organizer']                             = 'event/organizer';
$route['organizer_post']                        = 'event/jobs';
$route['organizer/jobs/(.+)']                   = 'event/get_organizers_jobs/$1';
$route['organizer/events/(.+)']                 = 'event/get_organizers_events/$1';




$route['addevent']                              = 'event/index';
$route['addevent/save']                         = 'event/add';
$route['addevent/savemedia']                    = 'event/add_media';
$route['addevent/savejobs']                     = 'event/add_jobs';

// $route['addcomment/comment']                    = 'event/addComment';
// $route['jobsearch']                             = 'event/search';
// $route['profile']                               = 'event/profile';
$route['job']                                   = 'event/job';
$route['blogs']                                 = 'event/bloglist';
$route['send_request']                          = 'event/send_request';


/* 
$route['search/(.+)/(.+)/(.+)/(.+)/(.+)/(.+)/(.+)'] = 'search/read/$1/$2/$3/$4/$5/$6/$7';
$route['search/(.+)/(.+)/(.+)/(.+)/(.+)/(.+)']      = 'search/read/$1/$2/$3/$4/$5/$6';
$route['search/(.+)/(.+)/(.+)/(.+)/(.+)']           = 'search/read/$1/$2/$3/$4/$5';
$route['search/(.+)/(.+)/(.+)/(.+)']                = 'search/read/$1/$2/$3/$4';
$route['search/(.+)/(.+)/(.+)']                     = 'search/read/$1/$2/$3';
$route['search/(.+)/(.+)']                          = 'search/read/$1/$2';
*/

$route['search/(.+)']                               = 'search/index/$1';
$route['search']                                    = 'search/index';
$route['search_results']                            = 'search/read';
$route['search_query']                              = 'search/query';
$route['search-organizer']                          = 'search/search_organizer';


$route['read-cityes']                               = 'home/read_cityes';



//page routes
$route['(.+)/(.+)/(.+)/(.+)/(.+)']              = 'home/check_command/$5';
$route['(.+)/(.+)/(.+)/(.+)']                   = 'home/check_command/$4';
$route['(.+)/(.+)/(.+)']                        = 'home/check_command/$3';
$route['(.+)/(.+)']                             = 'home/check_command/$2';
$route['(.+)']                                  = 'home/check_command/$1';
