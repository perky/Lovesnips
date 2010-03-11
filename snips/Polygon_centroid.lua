function polygon_centroid(polygon)
    local poly_x = {}
    local poly_y = {}
    local n = #polygon / 2
    local a = 0
    local xcen,ycen = 0,0
    local atmp,ytmp,xtmp = 0,0,0
	
    for i=1,n do
        poly_x[i] = polygon[(2*i)-1]
        poly_y[i] = polygon[2*i]
    end
    poly_x[n+1] = poly_x[1]
    poly_y[n+1] = poly_y[1]
	
	for i=1, n do
		a = ((poly_x[i]*poly_y[i+1]) - (poly_y[i]*poly_x[i+1]))
		atmp = atmp + a
		xtmp = xtmp + (poly_x[i+1] + poly_x[i]) * a
		ytmp = ytmp + (poly_y[i+1] + poly_y[i]) * a
	end
	if atmp ~= 0 then
		xcen = xtmp / (3*atmp)
		ycen = ytmp / (3*atmp)
	end

    return xcen, ycen, math.abs(atmp)
end