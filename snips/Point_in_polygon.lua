function point_in_polygon(x,y,polygon)
    local inside,n,i,poly_x,poly_y,x1,x2,y1,y2,m,b,ix,iy
    inside = false
	poly_x = {}
	poly_y = {}
	
    n = #polygon / 2
	
    for i=1,n do
        poly_x[i] = polygon[(2*i)-1]
        poly_y[i] = polygon[2*i]
    end
    poly_x[n+1] = poly_x[1]
    poly_y[n+1] = poly_y[1]

    for i=1, n do
        x1 = poly_x[i]
        y1 = poly_y[i]
        x2 = poly_x[i+1]
        y2 = poly_y[i+1]
        if (((y1 <= y) and (y2 > y)) or ((y1 > y) and (y2 <= y))) then
            if (x1 == x2) then
                if (x1 > x) then inside = not inside end
            else
                m = (y2 - y1) / (x2 - x1)
                b = y1 - m * x1
                ix = (y - b) / m
                iy = y
                if (ix > x) then inside = not inside end
            end
        end
    end
    return inside
end