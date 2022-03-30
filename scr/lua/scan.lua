-- Usage:
-- 1. Save file to /etc/astra/scan.lua
-- 2. Change s and e values (s is a start address, e is an end address)
-- 3. Launch: astra /etc/astra/scan.lua

-- Config
timeout = 5
s = "238.1.2.0"
e = "238.1.2.110"

-- App
function ip_to_number(ip)
    ip = ip:split("%.")
    if #ip ~= 4 then return 0 end
    for k,v in ipairs(ip) do
        ip[k] = tonumber(v)
        if not ip[k] then return 0 end
    end
    return bit32.lshift(ip[1], 24) + bit32.lshift(ip[2], 16) + bit32.lshift(ip[3], 8) + (ip[4])
end

function number_to_ip(num)
    local ip1 = math.fmod(bit32.rshift(num, 24), 0x100)
    local ip2 = math.fmod(bit32.rshift(num, 16), 0x100)
    local ip3 = math.fmod(bit32.rshift(num, 8), 0x100)
    local ip4 = math.fmod(num, 0x100)
    return ip1 .. "." .. ip2 .. "." .. ip3 .. "." .. ip4
end

s = ip_to_number(s)
e = ip_to_number(e)
c = {}

function start_next()
    c.t:close()
    c.t = nil
    c.i = nil
    c.a = nil
    collectgarbage()

    s = s + 1
    if s >= e then
        log.info("Stop scan")
        astra.exit()
    else
        scan_address()
    end
end

function scan_address()
    c.t = timer({
        interval = timeout,
        callback = function()
            start_next()
        end
    })
    local addr = number_to_ip(s)
    local name = "scan " .. addr
    c.i = udp_input({
        name = name,
        addr = addr,
        port = 1234,
    })
    c.a = analyze({
        upstream = c.i:stream(),
        name = name,
        join_pid = true,
        callback = function(data)
            if data.on_air then
                log.info(addr)
                start_next()
            end
        end,
    })
end

scan_address()