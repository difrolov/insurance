SELECT parent_id AS 'parent_section_id',
     if ( 
            ( SELECT parent_id FROM insur_insurance_object 
                WHERE id = parent_section_id AND parent_id = -1
            ), 'menu', 
            
            if ( 
                ( SELECT parent_id FROM insur_insurance_object 
                    WHERE id = parent_section_id AND parent_id = -1
                ), 'submenu', ''
            )
        )
    as 'parent_parent',
     ( SELECT name FROM insur_insurance_object 
            WHERE id = parent_section_id ) as 'parent',
`name`, alias, `title`, `description`, `keywords`, `content`
FROM insur_insurance_object
WHERE parent_id <> -1 AND parent_id <> -2
ORDER BY parent_parent DESC;