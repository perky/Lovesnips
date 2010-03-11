function .spline( t, knots )
	local nspans,span,knot,c3,c2,c1,c0
	nspans = #knots
	if nspans < 1 then return 0 end
	t = math.min( math.max(t,0), 1) * nspans
	span = math.floor(t)
	if span >= #knots-3 then span = #knots-3 end
	t = t-span
	c3 = -0.5 * knots[1]+1.5 * knots[2]-1.5 * knots[3]+0.5 * knots[4]
	c2 = knots[1]-2.5 * knots[2]+2 * knots[3]-0.5 * knots[4]
	c1 = -0.5 * knots[1]+0.5 * knots[3]
	c0 = knots[2]
	return ((c3*t+c2)*t+c1)*t+c0
end