	/**
	* Create new Account with given array of parameters
	* @param array $args
	* @return array $response (status,account_id,reg_token)
	*/
	public function _create($args){
		extract($args);
		$cdt = time();
		$response = "";
		$reg_token = get_random_string(); //from utilities.php
                
                $first_name = trim($first_name);
                $last_name = trim($last_name);
                $email = trim($email);

		$sql = sprintf("INSERT INTO `".$this->accounts."` (`first_name`,`last_name`,`email`,`created`,`modified`,`reg_token`,`account_type`, `storage_path_id`, `loggedin_token`) VALUES ('%s','%s','%s','$cdt','$cdt','$reg_token','$account_type','".DEFAULT_STORAGE_PATH_ID."', MD5('%s'));",
			mysql_real_escape_string($first_name),
			mysql_real_escape_string($last_name),
			mysql_real_escape_string($email),
                        $reg_token
			);

		$result = mysql_query($sql);

		if($result){
			$response['status'] = "success";
			$response['account_id'] = mysql_insert_id();
			$response['reg_token'] = $reg_token;
		}else{
			$response['status'] = "failed";
			$response['account_id'] = "";
			$response['reg_token'] = "";
		}
		return $response;
	}