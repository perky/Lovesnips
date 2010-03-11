function pulse( a, b, t )
	if ((a <= t) and (t <= b)) then
		return 1
	else
		return 0
	end
end