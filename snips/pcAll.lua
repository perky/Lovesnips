--[[
Copyright (c) 2009 Bartbes

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the \"Software\"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
]]


pcAll = {}				--Create the table
pcAll_mt = {}				--Create the metatable
local wrap = {}				--Create the private table used for wrapping
local pcAll_private_mt = {}		--Create the metatable for the pcAll table
setmetatable(pcAll, pcAll_private_mt)	--Set the metatable

function pcAll:create_table(table)	--Create a wrapped table
	local t = {}			--The new table
	t.__origtable = table		--Store the original table, note I\'m not using index, this way I can write to the wrapped one and read that value from the original
	return setmetatable(t, pcAll_mt)
end

function pcAll:create_func(func)	--Create a wrapped function
	local t = {}			--New table
	t.f = func			--Store the function
	return setmetatable(t, wrap)	--Wrap it
end

function wrap:__call(...)		--The function where the original is pcalled
	return pcall(self.f, ...)
end

function pcAll_private_mt:__call(t)	--This is to make it possible to use the table pcAll as a function (example: wrap_table = pcAll(orig_table) )
	if type(t) == \"table\" then	--Check types and do what is needed
		return self:create_table(t)
	elseif type(t) == \"function\" then
		return self:create_func(t)
	else
		return nil
	end
end

function pcAll_mt:__index(key)		--This is the function equivalent of the __index table
	local v = self.__origtable[key] --Get the original value, invoking other metamethods
	if type(v) ~= \"function\" then return v end
	local t = {}			--Apparently it was a function, so let\'s create a wrapped one
	t.f = v				--Set up the table
	return setmetatable(t, wrap)	--Make wrap the metatable, thus allowing it to use the __call field
end

function pcAll_mt:__newindex(key, value)--All assignments are passed on to the original table, invoking other metamethods
	self.__origtable[key] = value	--Set it
end
