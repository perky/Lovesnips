function roundrect( x, y, width, height, radius, color )
	local oldColor = love.graphics.getColor( )
	color = color or oldColor
	love.graphics.setColor( color )
	love.graphics.circle( 0, x, y, radius, 100 )
	love.graphics.circle( 0, x+width-radius, y, radius, 100 )
	love.graphics.circle( 0, x, y+height-radius, radius, 100 )
	love.graphics.circle( 0, x+width-radius, y+height-radius, radius, 100 )
	love.graphics.rectangle( 0, x, y-radius, width-radius, height+radius )
	love.graphics.rectangle( 0, x-radius, y, width+radius, height-radius )
	love.graphics.setColor( oldColor )
end