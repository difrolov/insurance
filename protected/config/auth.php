<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
	'user' => array(
			'type' => CAuthItem::TYPE_ROLE,
			'description' => 'user',
			'children' => array(
					'guest',         // позволим админу всё, что позволено модератору
			),
			'bizRule' => null,
			'data' => null
	),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'admin',
        'children' => array(
            'guest',         // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null
    ),
);