SELECT id,name, t1.`parent_id`,alias, 
( SELECT COUNT(*) AS cnt FROM insur_insurance_object
WHERE parent_id = t1.id
AND `status` = 1
) AS children, `priority` 
FROM insur_insurance_object as t1 
LEFT JOIN order_by_menu AS p ON p.id_object = id 
WHERE t1.parent_id = 2 AND `status` = 1
ORDER BY p.priority ASC