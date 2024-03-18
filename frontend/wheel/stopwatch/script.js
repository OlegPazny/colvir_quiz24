//TODO: make it look better
let time = 0;
let stopped;
let running = 0;

function timer()
{
	if (running)
	{
		$('h1').html(format(time))
		time++
		stopped = setTimeout(timer, 10)
	}
}

function start()
{
		running = 1
		timer()
}

function stop()
{
	running = 0
	clearTimeout(time)
}

function lap()
{
	$('#display').html('lap: ' + format(time))
}

function reset()
{
	time = 0
	running = 0
	clearTimeout(0)
	$('h1').html(format(0))
	$('#display').html('lap: 00:00:00')
}

function format(t)
{
	let mil
	let sec
	let min
	mil = place(t%100)
	sec = place(parseInt(t/100)%60)
	min = place(parseInt(t/6000))
	return min + ':' + sec + ':' + mil
}

function place(n)
{
	return n < 10 ? '0' + n : n
}