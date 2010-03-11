function point_in_triangle(x1,y1,x2,y2,x3,y3,tx,ty)
	local a,b,c
	a = (x1 - tx)*(y2 - ty) - (x2 - tx)*(y1 - ty)
    b = (x2 - tx)*(y3 - ty) - (x3 - tx)*(y2 - ty)
    c = (x3 - tx)*(y1 - ty) - (x1 - tx)*(y3 - ty)
    return (math_sign(a) == math_sign(b) and math_sign(b) == math_sign(c));
end