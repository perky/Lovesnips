function smoothstep( a, b, t )
	local p
	if t < a then return 0 end
	if t >= b then return 1 end
	if a == b then return false end
	p = (t-a) / (b-a)
	return (p*p*(3-2*p))
end