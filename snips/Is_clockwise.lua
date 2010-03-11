function is_clockwise(x1,y1,x2,y2,x3,y3)
    local m,b,cw
    cw = -1
    if ((x1 ~= x2) or (y1 ~= y2)) then
        if (x1 == x2) then
            cw = xor_boolean( (x3 < x2), (y1 > y2) )
        else
            m = (y1 - y2) / (x1 - x2)
            b = y1 - m * x1
            cw = xor_boolean( (y3 > (m * x3 + b)), (x1 > x2) )
        end
    end
    return cw
end