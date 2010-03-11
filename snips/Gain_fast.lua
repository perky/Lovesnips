function .gain_fast( g, t )
	local p
	p = (1/g-2)*(1-2*t);
    if t < 0.5 then 
		return t/(p+1)
	else
		return (p-t)/(p-1)
	end
end