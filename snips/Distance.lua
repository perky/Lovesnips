function distance(x1,y1,x2,y2)
	local xd = x2-x1
	local yd = y2-y1
	return math.sqrt( xd*xd + yd*yd )
end