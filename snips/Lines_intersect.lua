function lines_intersect(x1,y1,x2,y2,x3,y3,x4,x4,segment)
	local ua = 0
	local ud = (y4-y3) * (x2-x1) - (x4-x3) * (y2-y1)
	if ud ~= 0 then
		ua = ((x4 - x3) * (y1 - y3) - (y4 - y3) * (x1 - x3)) / ud
        if segment then
            ub = ((x2 - x1) * (y1 - y3) - (y2 - y1) * (x1 - x3)) / ud
            if (ua < 0 or ua > 1 or ub < 0 or ub > 1) then
				ua = 0
			end
        end
	end
	return ua
end