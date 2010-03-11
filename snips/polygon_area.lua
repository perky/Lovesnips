function polygon_area(polygon)
    local poly_x = {}
    local poly_y = {}
    local n = #polygon / 2
    local a = 0
	
    for i=1,n do
        poly_x[i] = polygon[(2*i)-1]
        poly_y[i] = polygon[2*i]
    end
    poly_x[n+1] = poly_x[1]
    poly_y[n+1] = poly_y[1]
	
    for i=1, n do
	a = a + ((poly_x[i]*poly_y[i+1]) - (poly_y[i]*poly_x[i+1]))
    end

    return math.abs(a) * 0.5
end