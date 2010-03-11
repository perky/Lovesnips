function triangle_equal(ftype, x,y, r, angle)
	local ang = angle or 0
	local rad = math.rad
	local ax, ay = x + r*math.cos(rad(0+ang)), y + r*math.sin(rad(0+ang))
	local bx, by = x + r*math.cos(rad(120+ang)), y + r*math.sin(rad(120+ang))
	local cx, cy = x + r*math.cos(rad(240+ang)), y + r*math.sin(rad(240+ang))
	love.graphics.triangle(ftype, ax,ay, cx,cy, bx,by)
end