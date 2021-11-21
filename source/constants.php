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
