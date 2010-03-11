function distance_point_line(x1,y1,x2,y2,x3,y3,segment)
    local t, x0, y0
    local dx = x2 - x1
    local dy = y2 - y1
    if ((dx == 0) and (dy == 0)) then
        x0 = x1
        y0 = y1
    else
        t = ((x3 - x1) * dx + (y3 - y1) * dy) / (dx * dx + dy * dy)
        if (segment) then t = math.min(math.max(0,t),1) end
        x0 = x1 + t * dx
        y0 = y1 + t * dy
    }
    return distance(x3,y3,x0,y0)
end