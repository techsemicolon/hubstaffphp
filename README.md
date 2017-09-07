# Hubstaff Package for PHP

This is a PHP package which integrates hubstaff API and gives you an efficient way to add hubstaff data/reports into your project. There are many improvements in terms of optimization in this package which are discussed below when applicable.

## Installation

Via Composer

``` bash
$ composer require techsemicolon/hubstaff
```

## Getting your API credentials

You will following 3 credentials to start with your hubstaff API integration : 

1. Email : The email address you use to login into hubstaff
2. Password : The secure password you use to login into hubstaff
3. App Token : This is an API key which you can get by following below steps : 

    - Visit https://developer.hubstaff.com/
    - Login using email and password mentioned above
    - Go to My Apps on the left hand side menu (URL : https://developer.hubstaff.com/my_apps)
    - Click on "Create App" button
    - Enter the name of your application
    - Select The organization from the dropdown if you have multiple organizations
    - Click on "Save" and you will have your App Token which is a long alphanumeric string
    - Keep it safe, preferably store it in your env(environmental files) and not in your actual application 

## Getting data from the APIs

To check out hubstaff APIs reference, you can visit their official documentation url https://api.hubstaff.com/v1/

How it internally works : 

1. Hubstaff asks for email and password to get the auth token. Auth token is different that your app token. App token is like an API key whereas auth token is a secured authentication mechanism to make sure the request getting sent for API is well authenticated.
2. Then we use Auth Token and App Token together in headers to get the data we want

Don't Worry :  Everything mentioned above is handled internally by the package, so there is no overhead for you ;)

Expiry of Auth Token : 

Apparently the auth token for Hubstaff does not have any expiry. Hence, once you get an auth token, you can use it like forever within the application. 

Getting auth token on every request :

I will suggest you to get the auth token using from https://developer.hubstaff.com/docs/api#!/auth/postV1Auth and save it in your env file to use within your application. This package has a flexibility to get auth token dynamically as the parameter of $authToken in authenticate() method is optional. However if the auth token is not having any expiry, it makes sence to get it once and save it to reuse rather than calling auth token API frequently. Also their server will throw error 429 which means too many requests for a particular API endpoint. So its better to get auth token and save it in your env just like you may save your app token.

To get any data using method you can use following example: 


```php
require_once('vendor/autoload.php');

use Hubstaff\Hubstaff;
//Get instance of Hubstaff

$hubstaff = Hubstaff::getInstance();

// Authenticate hubstaff with credentials you have
$appToken = 'your_app_token';
$email = 'your_hubstaff_email';
$password = 'your_hubstaff_password';
$authToken = 'your_auth_token';

$hubstaff->authenticate($appToken, $email, $password, $authToken);

//Get Repository you want and call the method on the same
$users = $hubstaff->getRepository('user')->getAllUsers();
```

Note : We have used singleton pattern internally to make sure that once authenticated, it uses the same instance everywhere for optimization and efficienty purposes.

Following table gives details description of methods available :

| Action               	                   | Repository | Method         | Parameters                          |
|:-----------------------------------------|:-----------|:---------------|:------------------------------------|
| **Users**                                |                   					                               |
| Retrieve list of users       	           | user | $hubstaff->getRepository('user')->getAllUsers() | $organizationMemberships (boolean : optional), $projectMemberships (boolean : optional)|
| Retrieve a user details       	       | user | $hubstaff->getRepository('user')->getUserDetail() | $userId (integer : required) |
| Retrieve organization memberships for a user       	       | user | $hubstaff->getRepository('user')->getUserOrgMemberships() | $userId (integer : required) $offset (integer : optional)|
| Retrieve project memberships for a user       	       | user | $hubstaff->getRepository('user')->getUserProjectMemberships() | $userId (integer : required) $offset (integer : optional)|
| **Organizations**                                |                   					                               |
| Retrieve list of organizations       	           | organization | $hubstaff->getRepository('organization')->getAllOrgs() | $offset (integer : optional) |
| Retrieve a organization details       	       | organization | $hubstaff->getRepository('organization')->getOrgDetail() | $orgId (integer : required) |
| Retrieve projects for an organization      	   | organization | $hubstaff->getRepository('organization')->getUserOrgMemberships() | $orgId (integer : required) $offset (integer : optional)|
| Retrieve users for an organization       	       | organization | $hubstaff->getRepository('organization')->getOrgUsers() | $orgId (integer : required) $offset (integer : optional)|
| **Projects**                                |                   					                               |
| Retrieve list of projects       	           | project | $hubstaff->getRepository('project')->getAllProjects() | $status (string : optional : values - active, archived ) $offset (integer : optional) |
| Retrieve a project details       	       | project | $hubstaff->getRepository('project')->getProjectDetail() | $projectId (integer : required) |
| Retrieve users for a project      	   | project | $hubstaff->getRepository('project')->getProjectUsers() | $projectId (integer : required) $offset (integer : optional)  $includeRemoved (boolean : optional)|
| **Activities**                                |                   					                               |
| Retrieve list of activities       	           | activity | $hubstaff->getRepository('project')->getActivities() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |
| Retrieve applications(programs used) of activities       	       | activity | $hubstaff->getRepository('project')->getActivityApplications() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |
| Retrieve urls of activities       	       | activity | $hubstaff->getRepository('project')->getActivityUrls() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |
| **Screenshots**                                |                   					                               |
| Retrieve list of screenshots       	           | screenshot | $hubstaff->getRepository('screenshot')->getScreenshots() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |
| **Notes**                                |                   					                               |
| Retrieve list of notes       	           | note | $hubstaff->getRepository('note')->getNotes() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |
| Retrieve a note details       	       | note | $hubstaff->getRepository('note')->getNoteDetail() | $noteId (integer : required) |
| **Tasks**                                |                   					                               |
| Retrieve list of tasks       	           | task | $hubstaff->getRepository('task')->getTasks() | $projectIds (array : optional) $offset (integer : optional) |
| Retrieve a task details       	       | task | $hubstaff->getRepository('task')->getTaskDetail() | $taskId (integer : required) |
| **Weekly Reports**                                |                   					                               |
| Retrieve time worked team report for a week       	           | report | $hubstaff->getRepository('report')->getWeeklyTeamReport() | $date (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) |
| Retrieve time worked my report for a week       	       | report | $hubstaff->getRepository('report')->getWeeklyMyReport() | $date (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) |
| **Custom Reports**                             |                   					                               |
| Retrieve custom team report grouped by date | report | $hubstaff->getRepository('report')->getCustomTeamReportByDate() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional)|
| Retrieve custom my report grouped by date       	           | report | $hubstaff->getRepository('report')->getCustomMyReportByDate() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| Retrieve custom team report grouped by member       	           | report | $hubstaff->getRepository('report')->getCustomTeamReportByMember() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| Retrieve custom my report grouped by member       	           | report | $hubstaff->getRepository('report')->getCustomMyReportByMember() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| Retrieve custom team report grouped by project       	           | report | $hubstaff->getRepository('report')->getCustomTeamReportByProject() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| Retrieve custom my report grouped by project       	           | report | $hubstaff->getRepository('report')->getCustomMyReportByProject() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| **Logs**                                |                   					                               |
| Retrieve list of time edit logs       	           | report | $hubstaff->getRepository('report')->getTimeEditLogs() | $startDate (date : required : Y-m-d) $endDate (date : required : Y-m-d) $organizationIds (array : optional) $projectIds (array : optional) $userIds (array : optional) $showTasks (boolean : optional) $showNotes (boolean : optional) $showActivity (boolean : optional) $includeArchived (boolean : optional) |
| **Team Payments**                                |                   					                               |
| Retrieve list of team payments       	           | payment | $hubstaff->getRepository('payment')->getTimeEditLogs() | $startTime (date : required : Y-m-d H:i:s) $stopTime (date : required : Y-m-d H:i:s) $organizationIds (array : optional) $userIds (array : optional) $offset (integer : optional) |








