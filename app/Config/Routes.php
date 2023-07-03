<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('users/create', 'Users::create');
$routes->post('users/create', 'Users::create');
$routes->get('user/profile', 'Users::profile');
$routes->get('users/delete/(:num)', 'Users::delete/$1');
$routes->get('users/block/(:num)', 'Users::block/$1');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/edit/(:num)', 'Users::edit/$1');

// USER PROFILE
$routes->get('user/profile/comingEvents', 'Users::coming');
$routes->get('user/profile/pastEvents', 'Users::past');
$routes->get('user/profile/comments', 'Users::comment');
$routes->get('user/profile/formations', 'Users::formation');
$routes->get('user/profile/account/(:num)', 'Users::account/$1');
$routes->post('user/profile/account/(:num)', 'Users::account/$1');
$routes->get('user/formation/certificate/(:num)/(:num)', 'Users::certificate/$1/$2'); 

$routes->post('contractors/create', 'Contractor::create');
$routes->get('contractors/create', 'Contractor::create');

$routes->get('signIn', 'SignIn::SignIn');
$routes->post('signIn', 'SignIn::SignIn');
$routes->get('users/index', 'Home::index');

$routes->get('signOut', 'SignIn::SignOut');

$routes->get('users/signUp', 'Users::SignUp');
$routes->post('users/signUp', 'Users::SignUp');

$routes->get('password/forgottenPassword', 'Password::forgottenPassword');
$routes->get('password/resetPassword', 'Password::resetPassword');
//$routes->get('password/sendMailResetPassword', 'Password::sendMailResetPassword');

$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/userManagement', 'Dashboard::userManagement');
$routes->get('dashboard/eventManagement', 'Dashboard::eventManagement');
$routes->get('dashboard/subscriptionManagement', 'Dashboard::subscriptionManagement');
$routes->get('dashboard/premiseManagement', 'Dashboard::premiseManagement');

$routes->get('unauthorized', 'Authorization::unauthorized');

//SUBSCRIPTIONS
$routes->get('subscriptions', 'Subscription::index'); //show all subscriptions
$routes->get('subscription/create', 'Subscription::create');
$routes->post('subscription/create', 'Subscription::create');
$routes->get('subscription/delete/(:num)', 'Subscription::delete/$1');
$routes->get('subscription/edit/(:num)', 'Subscription::edit/$1');
$routes->post('subscription/edit/(:num)', 'Subscription::edit/$1');
$routes->get('subscription/(:num)', 'Subscription::show/$1'); //show one subscription

//CLIENT
$routes->get('client/subscribe', 'Client::subscribe'); //update subscription
$routes->post('client/book', 'Client::books'); //update subscription


//PAYMENT METHODS
$routes->get('checkout', 'Payment::checkout'); //display checkout form page

//CONTRACTOR TYPES
$routes->get('contractorTypes', 'ContractorType::index'); //show all contractorTypes
$routes->get('contractorType/create', 'ContractorType::create');
$routes->post('contractorType/create', 'ContractorType::create');
$routes->get('contractorType/delete/(:num)', 'ContractorType::delete/$1');

//LESSON
$routes->get('lessons', 'Lesson::index'); //show all lessons
$routes->get('lesson/create', 'Lesson::create');
$routes->post('lesson/create', 'Lesson::create');
$routes->get('lesson/delete/(:num)', 'Lesson::delete/$1');
$routes->get('lesson/edit/(:num)', 'Lesson::edit/$1');
$routes->post('lesson/edit/(:num)', 'Lesson::edit/$1');
$routes->get('lesson/(:num)', 'Lesson::show/$1'); //show one lesson

//LESSON GROUPS
$routes->get('lessonGroups', 'LessonGroup::index'); //show all lessonGroups
$routes->get('lessonGroup/add/', 'LessonGroup::add');
$routes->get('lessonGroup/add/group', 'LessonGroup::addgroup');
$routes->post('lessonGroup/add/group/', 'LessonGroup::addgroup/');
$routes->post('lessonGroup/add/', 'LessonGroup::add/');
$routes->get('lessonGroup/delete/(:num)', 'LessonGroup::delete/$1');

//EVENTS
$routes->get('events', 'Event::index'); //show all events
$routes->post('events', 'Event::index'); //search events
$routes->get('event/create', 'Event::create');
$routes->post('event/create', 'Event::create');
$routes->get('event/delete/(:num)', 'Event::delete/$1');
$routes->get('event/edit/(:num)', 'Event::edit/$1');
$routes->post('event/edit/(:num)', 'Event::edit/$1');
$routes->get('event/(:num)', 'Event::show/$1'); //show one event
$routes->post('event/join', 'Event::join');
$routes->post('event/leave', 'Event::leave');
$routes->get('event/close/(:num)', 'Event::close/$1');

//EVENTS CONTRACTORS
$routes->get('eventContractor/delete/(:num)/(:num)', 'EventContractor::delete/$1/$2');
$routes->get('eventContractor/add', 'EventContractor::addcontractor');
$routes->post('eventContractor/add', 'EventContractor::addcontractor/');
$routes->get('eventContractor/index/(:num)', 'EventContractor::index/$1');
$routes->get('eventContractor/validate/(:num)', 'EventContractor::clientValidation/$1'); //show one event
$routes->get('eventContractor/removeParticipant/(:num)/(:num)', 'EventContractor::removeParticipant/$1/$2');
$routes->get('eventContractor/addParticipant/(:num)/(:num)', 'EventContractor::addParticipant/$1/$2');


//EVENTS SPACE
$routes->get('eventSpace/delete/(:num)/(:num)', 'EventSpace::delete/$1/$2');
$routes->get('eventSpace/add', 'EventSpace::addspace');
$routes->post('eventSpace/add', 'EventSpace::addspace/');

//EVENTS GROUPS
$routes->get('eventGroups', 'EventGroup::index'); //show all lessonGroups
$routes->get('eventGroup/add/', 'EventGroup::add');
$routes->get('eventGroup/add/group', 'EventGroup::addgroup');
$routes->post('eventGroup/add/group/', 'EventGroup::addgroup/');
$routes->post('eventGroup/add/', 'EventGroup::add/');
$routes->get('eventGroup/delete/(:num)', 'EventGroup::delete/$1');

//EVENTS CONTRACTORS
$routes->get('eventContractor/delete/(:num)/(:num)', 'EventContractor::delete/$1/$2');
$routes->get('eventContractor/add', 'EventContractor::addcontractor');
$routes->post('eventContractor/add', 'EventContractor::addcontractor/');

//EVENTS SPACE
$routes->get('eventSpace/delete/(:num)/(:num)', 'EventSpace::delete/$1/$2');
$routes->get('eventSpace/add', 'EventSpace::addspace');
$routes->post('eventSpace/add', 'EventSpace::addspace/');

//EVENTS GROUPS
$routes->get('eventGroups', 'EventGroup::index'); //show all lessonGroups
$routes->get('eventGroup/add/', 'EventGroup::add');
$routes->get('eventGroup/add/group', 'EventGroup::addgroup');
$routes->post('eventGroup/add/group/', 'EventGroup::addgroup/');
$routes->post('eventGroup/add/', 'EventGroup::add/');
$routes->get('eventGroup/delete/(:num)', 'EventGroup::delete/$1');

//COMMENTS
$routes->get('comment/create/(:num)', 'Comment::create/$1');
$routes->post('comment/create/(:num)', 'Comment::create/$1');
$routes->get('comment/delete/(:num)/(:num)', 'Comment::delete/$1/$2');
$routes->get('comment/edit/(:num)/(:num)', 'Comment::edit/$1/$2');
$routes->post('comment/edit/(:num)/(:num)', 'Comment::edit/$1/$2');

//EVENT GROUPS
/*$routes->get('eventGroups', 'EventGroup::index'); //show all lessonGroups
$routes->get('eventGroup/add/', 'EventGroup::add');
$routes->post('eventGroup/add/', 'EventGroup::add/');
$routes->get('eventGroup/delete/(:num)', 'EventGroup::delete/$1');*/

//PREMISES
$routes->get('premises', 'Premise::index'); //show all premises
$routes->get('premise/create', 'Premise::create');
$routes->post('premise/create', 'Premise::create');
$routes->get('premise/delete/(:num)', 'Premise::delete/$1');
$routes->get('premise/edit/(:num)', 'Premise::edit/$1');
$routes->post('premise/edit/(:num)', 'Premise::edit/$1');
$routes->get('premise/(:num)', 'Premise::show/$1'); //show one premise

//COOKING SPACES
$routes->get('cookingSpace', 'CookingSpace::index'); //show all cookingspaces
$routes->get('cookingSpace/create', 'CookingSpace::create');
$routes->post('cookingSpace/create', 'CookingSpace::create');
$routes->get('cookingSpace/delete/(:num)', 'CookingSpace::delete/$1');
$routes->get('cookingSpace/edit/(:num)', 'CookingSpace::edit/$1');
$routes->post('cookingSpace/edit/(:num)', 'CookingSpace::edit/$1');
$routes->get('cookingSpace/(:num)', 'CookingSpace::show/$1'); //show one cookingSpace



$routes->get('unauthorized', 'Authorization::unauthorized');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
