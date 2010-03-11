function gain( g, t )
	if t < 0.5 then 
		return xtra.bias( 1-g, 2*t) / 2
	else
		return 1 - xtra.bias( 1-g, 2-2*t) / 2
	end
end