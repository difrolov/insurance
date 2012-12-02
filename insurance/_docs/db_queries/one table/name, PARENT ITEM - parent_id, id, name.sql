SELECT id,name,parent_id,alias, (
        SELECT CONCAT(
            'parent_id: ', 
            CONVERT(parent_id USING utf8),
            ', id ',
            CONVERT(id USING utf8),': ',name
        )
        FROM insur_insurance_object
        WHERE id = t1.parent_id
    ) as parent_menu 
    FROM insur_insurance_object AS t1
WHERE `content` <> '';