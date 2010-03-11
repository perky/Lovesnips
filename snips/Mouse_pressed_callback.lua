function mouse_pressed_callback( func, ... )
	if love.mouse.isDown(love.mouse_left) then
		if not clickCallbackIsDown then
			func( ... )
			clickCallbackIsDown = true
		end
	else
		clickCallbackIsDown = false
	end
end