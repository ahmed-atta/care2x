# Script to create an initial Admin access permission

INSERT INTO care_users (
    name,
	login_id,
	password,
	permission,
	exc,
    status,
	create_id,
	create_time
	)
	VALUES
	(
	'admin',
	'admin',
	'admin',
	'System_Admin',
	1,
	'Initial',
	'Installation',
	NULL
	);	
