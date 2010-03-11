function spline4( t, knot1, knot2, knot3, knot4 )
	local k0,k3,c3,c2,c1,c0
	if t <= 0 then return knot2 end
	if t >= 1 then return knot3 end
	k0 = -0.5 * knot1
	k3 = 0.5 * knot4
	c3 = k0 + 1.5 * knot2 - 1.5 * knot3 + k3;
    c2 = knot1 - 2.5 * knot2 + 2 * knot3 - k3;
    c1 = k0 + 0.5 * knot3;
    c0 = knot2;
    return ((c3 * t + c2) * t + c1) * t + c0;
end