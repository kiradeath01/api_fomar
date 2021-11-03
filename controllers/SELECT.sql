SELECT 
a.nombre_producto,
a.
FROM
cat_producto a
LEFT JOIN descripcion_producto b on b.id_producto= a.id_producto
LEFT JOIN cat_imagenes c on c.id_producto=a.id_producto
LEFT JOIN cat_promocion d on d.id_promocion=a.id_promocion