<?php

//Responses to use when fetching data from a query
const CONNECTION_FAILED = "Could not connect to the database";
const NO_DATA_FOUND = "No Data Found";
const SUCCESS = "Successfully fetched data from the database";

//Login Responses
const NO_USER_FOUND = "Could not find a user for the given email";
const CONNECTION_ERROR = "There was an error while fetching data";
const ACCOUNT_BLOCKED_OR_DELETED = "The account has been blocked or deleted. Please contact the Administrator";
const WRONG_PASSWORD = "Your password is incorrect";
const LOGIN_SUCCESSFUL = "User Login Successful";
const NEW_MEMBER = "This user is a new member";

//Session Responses
const SESSION_CREATION_SUCCESS = "Session Created Successfully";
const SESSION_DELETION_SUCCESS = "Session Deleted Successfully";
const SESSION_EXPIRED = "Session Deleted Successfully";
const SESSION_AVAILABLE = "Session Available for the given User ID";
const NO_SESSION_FOUND = "No Session Found for the given User ID";
const SESSION_ID_MISMATCH = "Session Ids did not match";

//Getting Details from Email
const MULTIPLE_RECORDS = "There are multiple records for the given email";

//Updating Password Responses
const PASSWORD_UPDATE_SUCCESS = "The password was updated successfully";
const PASSWORD_UPDATE_FAILURE = "Could not update the password";
const PASSWORD_FETCHING_FAILURE = "Could not fetch the current password from the database";
const VALID_CURRENT_PASSWORD = "Current Password matches with the Password in Database";
const INVALID_CURRENT_PASSWORD = "Current Password does not match with the Password in Database";

//Updating User Data Responses
const USERDATA_UPDATE_SUCCESS = "The user details were updated successfully";
const USERDATA_UPDATE_FAILURE = "Could not update user details";

//Uploading Profile Picture Responses
const UPLOADING_PROFILE_PIC_SUCCESS = "Profile Picture Uploaded Successfully";
const NO_PROFILE_PICTURE_TO_FETCH = "No Profile Picture Available";

//Fetching Profile Picture File Name
const UNABLE_TO_FETCH_PROFILE_PIC_NAME = "Unable to fetch profile picture name";
const FETCHING_PROFILE_PIC_NAME_SUCCESS = "Profile Picture Name Fetched Uploaded Successfully";