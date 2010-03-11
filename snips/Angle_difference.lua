function angle_difference( angle1, angle2 )
	return ((((angle1 - angle2) % 360) + 540) % 360) - 180
end