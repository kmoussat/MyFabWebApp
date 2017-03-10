<?php
require_once "google/google-api-php-client/src/Google_Client.php";

require_once "google/google-api-php-client/src/contrib/Google_DriveService.php";

require_once "google/google-api-php-client/src/contrib/Google_Oauth2Service.php";
 
require_once "google/vendor/autoload.php";

$DRIVE_SCOPE = 'https://www.googleapis.com/auth/drive';
$SERVICE_ACCOUNT_EMAIL = 'myfab-725@myfab-158803.iam.gserviceaccount.com';
$SERVICE_ACCOUNT_PKCS12_FILE_PATH = 'MyFab-621272c02a49.p12';

function buildService() {//function for first build up service
global $DRIVE_SCOPE, $SERVICE_ACCOUNT_EMAIL, $SERVICE_ACCOUNT_PKCS12_FILE_PATH;

  $key = file_get_contents($SERVICE_ACCOUNT_PKCS12_FILE_PATH);
  $auth = new Google_AssertionCredentials(
      $SERVICE_ACCOUNT_EMAIL,
      array($DRIVE_SCOPE),
      $key);
  $client = new Google_Client();
  $client->setUseObjects(true);
  $client->setAssertionCredentials($auth);
  return new Google_DriveService($client);
}
function createPublicFolder($service, $folderName,$parentId) {//function for create a publlic folder

  $file = new Google_DriveFile();
  $file->setTitle($folderName);
  $file->setMimeType('application/vnd.google-apps.folder');
    $parent = new Google_ParentReference();
    $parent->setId($parentId);
    $file->setParents(array($parent));
  $createdFile = $service->files->insert($file, array(
      'mimeType' => 'application/vnd.google-apps.folder',
  ));
  //assign the file with MIME 
  $permission = new Google_Permission();
  $permission->setValue('me');
  $permission->setType('anyone');
  $permission->setRole('writer');
  //assign the permission

 $service->permissions->insert(
      $createdFile->getId(), $permission);

  return $createdFile;
}
try {


$root_id='0B20cPsqZXZ0jXzFTUVM5Q1F5cnM';
echo $root_id;
echo " ";

$service=buildService();

$limit=1;
for($i=1;$i<=$limit;$i++){
  $folderName='waza'.$i;
  $parent=createPublicFolder($service, $folderName,$root_id);
  $root_id=$parent->getId();
  echo $root_id;
}


  } catch (Exception $e) {
  print "An error occurred1: " . $e->getMessage();
  }
?>