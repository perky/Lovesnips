function mouse_in_box( x1, y1, x2, y2 )
	if love.mouse.getX() > x1 and love.mouse.getX() < x2 and love.mouse.getY() > y1 and love.mouse.getY() < y2 then
		return true
	end
	return false
end