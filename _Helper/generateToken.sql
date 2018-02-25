SET @i = (SELECT COUNT(*) FROM token_list);

INSERT INTO token_list (`token`)
VALUES (
	SUBSTR(
		CONCAT(
			sha1(
				CONCAT(
					NOW(),
					(@i)
				)
			),
			sha1(
				CONCAT(
					DATE_ADD(
						NOW(),
						INTERVAL +2 DAY
					),
					(@i)
				)
			)
		),
		1,
		64
	)
)