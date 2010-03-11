function boxstep( a, b, t )
	local p
	if a == b then return 0 end
	p = (t-a) / (b-a)
	if p <= 0 then return 0 end
	if p >= 1 then return 1 end
	return p
end