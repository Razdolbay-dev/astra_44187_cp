--defdir = "/etc/astra/lua"
logfile = "/var/log/astra.log"
os.remove(logfile)
log.set({ filename = logfile })

_an = {}
local hostname = utils.hostname()
local content = ""
local _t = 2
local event_request = { host = "127.0.0.1", path = "/monitor.php", port = 80 }

dofile("/var/www/html/config.ini")

function send_monitor(content)
  http_request({
    host = event_request.host,
    port = event_request.port,
    path = event_request.path,
    method = "POST",
    content = content,
    headers = {
        "Host: " .. event_request.host .. ":" .. event_request.port,
        "Content-Type: application/json",
        "Content-Length: " .. #content,
        "Connection: close"
    },
    callback = function(self, response)
    end
  })
end

for q,item in pairs(channels)do
  local output = item.output[1]
  local type = "stream"
  make_channel(item)
  _an[q] = {i = {}, a = {}, t = 2}
  _an[q].i = udp_input(parse_url(item.output[1]))
  _an[q].a = analyze({
      upstream = _an[q].i:stream(),
      name = "_" .. item.name,
      callback = function(data)
        if(data.total) then
          local scram = 0
          local onair = 0
          if(data.total.scrambled==true) then
            scram = 1
          end
          if(data.on_air==true) then
            onair = 1
          end
          content = json.encode({
            type = type,
            channel_id = item.name,
            scrambled = scram,
            bitrate = data.total.bitrate,
            cc_error = data.total.cc_errors,
            pes_error = data.total.pes_errors,
            ready = onair,
          })
          send_monitor(content)
          --log.info(content)
          _an[q].t = 0
        end
        _an[q].t = _an[q].t + 1
      end 
  })
end
