SELECT id,name,`status`, 
    if (parent_id<0,null,
        (SELECT name FROM insur_insurance_object  
        WHERE id = i2.parent_id)
    ) AS parent 
    FROM insur_insurance_object as i2
ORDER BY name,parent;
