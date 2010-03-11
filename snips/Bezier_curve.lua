function bezier_curve(x1,y1,hx1,hy1, x2,y2,hx2,hy2, samples)
	local samples = samples or 500
	local s = 1/samples
	local Ax = x1 + hx1
	local Ay = y1 + hy1
	local Bx = x2 + hx2
	local By = y2 + hy2
	
	local n,xn,yn
	for t=0,1,s do
		n = 1-t
		xn = n*n*n*x1+3*t*n*n*Ax+3*t*t*n*Bx+t*t*t*x2
		yn = n*n*n*y1+3*t*n*n*Ay+3*t*t*n*By+t*t*t*y2
		love.graphics.point( xn, yn )
	end
end