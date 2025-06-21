<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database_config.php';
$pdo=connectToDatabase($dbCredentials);
session_start();
require_once __DIR__ . '/../public/header.php';


if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page='home';
}

$viewPath = __DIR__ . '/../src/View/' . $page . '.php';

require_once __DIR__ . '/../src/Controller/ProfileController.php';
if(isset($_SESSION['user_id'])){
	$UserID=$_SESSION['user_id'];
	$profileController=new ProfileController($pdo);
	$fetched_profile=$profileController->getProfile($UserID);
}

switch ($page) {
	case 'register':
        require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
        $userController->register();
        break;
		
	case 'login':
		require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
		$userController->login();
		break;

	case 'logout':
        require_once __DIR__ . '/../src/Controller/AuthController.php';
        $userController = new UserController($pdo);
        $userController->logout();
        break;
		
	case 'profile':
		require_once __DIR__ . '/../src/Controller/ProfileController.php';
		$profileController=new ProfileController($pdo);
		$profileController->viewProfile();
		break;
	case 'catalogue':
		require_once __DIR__ . '/../src/Controller/CatalogueController.php';
		$catalogueController=new CatalogueController($pdo);
		$catalogueController->viewCatalogue();
		break;

	case 'admin_login':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->login();
        break;

    case 'admin_dashboard':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->dashboard();
        break;

    case 'admin_view_profile':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->viewUserProfile();
        break;

    case 'admin_edit_profile':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->editUserProfile();
        break;

	case 'admin_manage_user':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->manageUser();
        break;

    case 'admin_delete_talent':
        require_once __DIR__ . '/../src/Controller/AdminController.php';
        $adminController = new AdminController($pdo);
        $adminController->deleteTalent();
        break;

	case 'talent':
		require_once __DIR__ . '/../src/Controller/TalentController.php';
		$talentController=new TalentController($pdo);
		if(isset($_GET['id'])){ // index.php?page=X&id=Y
			$talent_id=$_GET['id'];
			if(isset($_GET['action'])){
				if($_GET['action']=="del"){
					$talentController->deleteTalent($talent_id);
					break;
				}elseif($_GET['action']=="edit"){
					$talentController->editTalent($talent_id);
					break;
				}elseif($_GET['action']=="like"){
					$talentController->likeTalent($talent_id);
					break;
				}elseif($_GET['action']=="comment"){
					$talentController->addComment($talent_id);
					break;
				}elseif($_GET['action']=="portfolio"){
					if(isset($_GET['followerID'])&&isset($_GET['followingID'])){
						// echo "post";
						require_once __DIR__ . '/../src/Controller/AuthController.php';
						$userController=new UserController($pdo);
						$FollowerID=$_GET['followerID'];
						$FollowingID=$_GET['followingID'];
						$userController->followUser($FollowerID, $FollowingID);
						break;
					}
					$user_id=$_GET['id'];
					// echo "no post";
					$talentController->viewTalent($user_id);
					break;
				}elseif($_GET['action']=="follow"){
					if(isset($_GET['followerID'])&&isset($_GET['followingID'])){
						// echo "pßost";
						require_once __DIR__ . '/../src/Controller/AuthController.php';
						$userController=new UserController($pdo);
						$FollowerID=$_GET['followerID'];
						$FollowingID=$_GET['followingID'];
						$userController->followUser($FollowerID, $FollowingID, $talent_id);
						break;
					}
				}
				
			}

			$talentController->viewSpecificTalent($talent_id);
			break;
		}

	case 'forum':
		require_once __DIR__ . '/../src/Controller/ForumController.php';
        $forumController = new ForumController($pdo);

		if(isset($_GET['id'])){	// index.php?page=X&id=Y
			$forum_id=$_GET['id'];
			if($_GET['action']=="join"){ // index.php?page=X&id=Y&action=Z
				$forumController->joinForum($forum_id);
				break;
			}elseif($_GET['action']=="view"){ // index.php?page=X&id=Y&action=Z
				$forumController->viewForumDetails($forum_id);
				break;
			
			}elseif($_GET['action']=="joined"){ // index.php?page=X&id=Y&action=Z
				$user_id=$_GET['id']; // to display forums a specific user has joined
				$forumController->viewJoinedForums($user_id);
				break;
			}elseif($_GET['action']=="create-post"){ // index.php?page=X&id=Y&action=Z
				$forumController->createForum();
				break;
			}
		}elseif(isset($_GET['action'])){// index.php?page=X&action=Y
			if($_GET['action']=="create"){
				$forumController->createForum();
				break;
			}
		}
		$forumController->browseForum();
		break;

	case 'forum-post':
		require_once __DIR__ . '/../src/Controller/ForumController.php';
        $forumController = new ForumController($pdo);
		if(isset($_GET['id'])){	// index.php?page=X&id=Y 
			if(isset($_GET['action'])){// index.php?page=X&action=Y
				if($_GET['action']=="create"){
					$forum_id=$_GET['id']; // and this is the forum id because each post is in a forum
					$forumController->createForumPost($forum_id);
					break;
				}
				elseif($_GET['action']=="view"){
					$forum_post_id=$_GET['id']; // and this is the forum post id
					$forumController->viewForumPostDetails($forum_post_id);
					break;
				}elseif($_GET['action']=="like"){
					$forum_post_id=$_GET['id']; // and this is the forum post id
					$forumController->likeForumPost($forum_post_id);
					break;
				}elseif($_GET['action']=="comment"){
					$forum_post_id=$_GET['id']; // and this is the forum post id
					$forumController->addComment($forum_post_id);
					break;
				}
			}
		}
		
		break;

	case 'follow':
		require_once __DIR__ . '/../src/Controller/AuthController.php';
		$userController=new UserController($pdo);
		if(isset($_GET['followerID'])&&isset($_GET['followingID'])){
			$FollowerID=$_GET['followerID'];
			$FollowingID=$_GET['followingID'];
			$userController->followUser($FollowerID, $FollowingID);
			break;
		}

	case 'announcement':
		require_once __DIR__ . '/../src/Controller/AnnouncementController.php';
		$announcementController=new AnnouncementController($pdo);
		$announcementController->viewAnnouncement();
		break;

	case 'admin_manage_announcement':
		require_once __DIR__ . '/../src/Controller/AnnouncementController.php';
		$announcementController=new AnnouncementController($pdo);

		if(isset($_GET['action'])){ // index.php?page=X&action=Y
			if($_GET['action']=="create"){
				$announcementController->createAdminAnnouncement();
				break;
			}elseif($_GET['action']=="edit"){
				$announcement_id=$_GET['id'];
				$announcementController->createAdminAnnouncement($announcement_id);
				break;
			}elseif($_GET['action']=="delete"){
				$announcement_id=$_GET['id'];
				$announcementController->deleteAdminAnnouncement($announcement_id);
				break;
			}
		}
		$announcementController->viewAdminAnnouncement();
		break;

	case 'feedback':
		require_once __DIR__ . '/../src/Controller/FeedbackController.php';
		$feedbackController=new FeedbackController($pdo);
		$feedbackController->viewFeedback();
		break;

	// public/index.php (relevant part)

	case 'admin_manage_feedback':
		require_once __DIR__ . '/../src/Controller/FeedbackController.php';
		$feedbackController = new FeedbackController($pdo);

		if (isset($_GET['action'])) { 
			if ($_GET['action'] == "update") {
				$feedback_id = $_GET['id'];
				$feedbackController->updateAdminFeedback($feedback_id);
				break;
			} elseif ($_GET['action'] == "delete") { 
				$feedback_id = $_GET['id']; 
				if ($feedback_id) { 
					$feedbackController->deleteAdminFeedback($feedback_id);
				} else {
					$_SESSION['error_message'] = "Feedback ID is missing for deletion.";
					header("Location: /talent-portal/public/index.php?page=admin_manage_feedback");
					exit;
				}
				break; 
			}
		}
		// If no action is specified, or action not matched, view all feedback
		$feedbackController->viewAdminFeedback();
		break;

	
	default:
		if(file_exists($viewPath)) {
			require_once $viewPath;
		}else {
			http_response_code(404);
			echo "<h1>404 - Page Not Found</h1>";
		}
}


