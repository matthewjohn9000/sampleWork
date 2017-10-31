<?php 


/**
* Provides methods to query data throughout the app
* 
* @return : an array of rows returned by the database. Each row is an object.
*/
class QUERY {

	private $DB;
	var $debug = false;

	function __construct($DB) {
		$this->DB = $DB;
	}
	
	/**
	*	Queries a user's information based on the given id!
	*
	*	@param $user_id (string or int) : The user id.
	*/
	public function USER($user_id) {
		
		if ($user_id == "*") {
			// All users
			
			$sql = "SELECT * FROM users";

			$result = $this->DB->QUERY($sql, ["user_id" => $user_id])->fetchAll();
			
		} else {
			// Single User

			$sql = "SELECT * FROM users WHERE id = :user_id LIMIT 1";

			$result = $this->DB->QUERY($sql, ["user_id" => $user_id])->fetch();
			
		}
				
		return $result;
	}

	/**
	*	Queries all users.
	*/
	public function USERS() {
				
		$result = $this->USER("*");
		
		return $result;
	}

	/**
	*	Queries surveys created by the passed user id!
	*	 
	*	@param $user_id (string or int) : The user id to get their surveys.
	*/
	function SURVEYS_CREATED($user_id) {
	
		$sql = "SELECT * FROM surveys WHERE author= :user_id";
		
		$paramsToBind = ["user_id" => $user_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries surveys joined by the passed user id!
	*	 
	*	@param $user_id (string or int) : The user id to get surveys they're joined.
	*/
	function SURVEYS_JOINED($user_id) {
	
		$sql = "SELECT * FROM surveys INNER JOIN survey_participants ON `surveys`.id = `survey_participants`.survey_id WHERE `survey_participants`.user_id = :user_id";
		
		$paramsToBind = ["user_id" => $user_id];
		
		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries a survey using the passed survey id!
	*	 
	*	@param $survey_id (string or int) : The survey id.
	*/
	function SURVEY($survey_id) {

		$sql = "SELECT * FROM surveys WHERE id = :survey_id LIMIT 1";

		$paramsToBind = ["survey_id" => $survey_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetch();
		
		return $result;
	}

	/**
	*	Queries the participants of a survey.
	*	 
	*	@param $survey_id (string or int) : The survey id.
	*/
	function SURVEY_PARTICIPANTS($survey_id) {

		$sql = "SELECT * FROM users INNER JOIN survey_participants ON `users`.id = `survey_participants`.user_id WHERE `survey_participants`.survey_id = :survey_id";

		$paramsToBind = ["survey_id" => $survey_id];

		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries the answers of a survey.
	*	 
	*	@param $survey_id 	(string or int) : The survey id.
	*	@param $reviewer_id (string or int) : The id of the reviewer user.
	*	@param $reviewee_id	(string or int) : The id of the user being reviewed.
	*/
	function ANSWERS($survey_id, $reviewer_id, $reviewee_id, $status = false) {
		
		$paramsToBind = [
			"survey_id" 	=> $survey_id,
		];
		
		$statusClause = ($status) ? "status = '$status'" : "TRUE";
		
		if ($reviewer_id == "*") {
			$reviewerClause = "TRUE";
		} else {
			$reviewerClause = "reviewer_id = :reviewer_id";
			$paramsToBind['reviewer_id'] = $reviewer_id;
		}
		
		if ($reviewee_id == "*") {
			$revieweeClause = "TRUE";
		} else {
			$revieweeClause = "reviewee_id = :reviewee_id";
			$paramsToBind['reviewee_id'] = $reviewee_id;
		}

		$sql = "SELECT * FROM answers WHERE survey_id = :survey_id AND $reviewerClause AND  $revieweeClause AND $statusClause";		
		
		$result = $this->DB->QUERY($sql, $paramsToBind, $this->debug)->fetchAll();
		
		return $result;
	}

	/**
	*	Queries answers to know if a questionnaire (collection of answers) is   
	* 	'submitted', 'published' or 'flagged'.
	*	 
	*	@param $survey_id 	(string or int) : The survey id.
	*	@param $reviewer_id (string or int) : The id of the person reviewing.
	*	@param $reviewee_id (string or int) : The id of the person being reviewed.
	*
	*	@return The status : 'submitted', 'published', 'flagged' or null if no answer.
	*/
	function QUESTIONNAIRE_STATUS($survey_id, $reviewer_id, $reviewee_id) {

		$answers = $this->ANSWERS($survey_id, $reviewer_id, $reviewee_id);

		$status = "published";

		if ($answers) {

			foreach ($answers as $answer) {
				
				if($answer->status == "flagged") {
					$status = "flagged";
					break; // once we find a flag then we break;
				
				} else if ($answer->status == "draft") {
					$status = "draft";
				}
			}

		} else {
			$status = null;
		}

		return $status;
	}

	function SURVEY_QUESTIONS($survey_id) {

		$sql = "SELECT * FROM questions INNER JOIN survey_questions ON `questions`.id = `survey_questions`.question_id WHERE survey_id = :survey_id";
		
		$paramsToBind = [
			":survey_id" => $survey_id,
		];

		$questions = $this->DB->QUERY($sql, $paramsToBind)->fetchAll();

		return $questions;

	}

	function SURVEY_ANSWERS_FOR_USER($survey_id, $user_id, $status = false) {

		$answers = $this->ANSWERS($survey_id, $reviewer_id = "*", $user_id, $status);

		return $answers;
	}

	function IS_USER_IN_SURVEY($user_id, $survey_id) {

		$surveys_of_user = $this->SURVEYS_JOINED($user_id);

		foreach ($surveys_of_user as $survey) {
			if ($survey->id == $survey_id) {
				return true;
			}
		}

		return false;

	}

	function SURVEY_GRADING_SYSTEM($survey_id) {

		$survey = $this->SURVEY($survey_id);

		$grading_system = $survey->grading_system;

		if ($grading_system) {
			$sql = "SELECT * FROM grading_systems WHERE id = $grading_system";

			$grading_system = $this->DB->QUERY($sql);
		}

		return $grading_system;
	}

	function FLAG_ANSWER($answer_id, $comment) {
		return $this->DB->UPDATE("answers", [
			"id=$answer_id"
			], [
			'comment' => $comment,
			'status' => 'flagged'
			]);
	}


}