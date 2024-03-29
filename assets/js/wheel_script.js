var padding = { top: 100, right: 500, bottom: 150, left: 0 },
    w = 1920 - padding.left - padding.right,
    h = 1080 - padding.top - padding.bottom,
    r = Math.min(w, h) / 2,
    rotation = 0,
    oldrotation = 0,
    picked = 100000,
    oldpick = [],
    color = d3.scale.category20();//category20c()
var data;
function qsoundStop() {
    qsound.pause();
    qsound.currentTime = 0;
}
$(document).ready(function () {
    $.ajax({
        url: '../../../assets/api/wheel_script.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            data = [];
            response.forEach(function (item) {
                var newItem = {
                    label: 'Вопрос #' + item.id,
                    value: item.id,
                    question: 'Вопрос #' + item.id + ' ' + item.type
                };
                data.push(newItem);
            });
            var svg = d3.select('#chart')
                .append("svg")
                .data([data])
                .attr("width", w + padding.left + padding.right)
                .attr("height", h + padding.top + padding.bottom);
            var container = svg.append("g")
                .attr("class", "chartholder")
                .attr("transform", "translate(" + (w / 2 + padding.left) + "," + (h / 2 + padding.top) + ")");
            var vis = container
                .append("g");

            var pie = d3.layout.pie().sort(null).value(function (d) { return 1; });
            // declare an arc generator function
            var arc = d3.svg.arc().outerRadius(r);
            // select paths, use arc generator to draw
            var arcs = vis.selectAll("g.slice")
                .data(pie)
                .enter()
                .append("g")
                .attr("class", "slice");

            arcs.append("path")
                .attr("fill", function (d, i) { return color(i); })
                .attr("d", function (d) { return arc(d); });
            // add the text
            arcs.append("text").attr("transform", function (d) {
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle) / 2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius - 10) + ")";
            })
                .attr("text-anchor", "end")
                .text(function (d, i) {
                    return data[i].label;
                });
            container.on("click", spin);
            function qsoundPlay() {
                var qsound = document.getElementById("qsound");
                qsound.volume = 0.1;
                qsound.play();
            }
            function qsoundStop() {
                qsound.pause();
                qsound.currentTime = 0;
            }
            function spin(d) {
                //msoundStop();
                qsoundPlay();
                container.on("click", null);
                //all slices have been seen, all done
                console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
                if (oldpick.length == data.length) {
                    console.log("done");
                    container.on("click", null);
                    return;
                }
                var ps = 360 / data.length,
                    pieslice = Math.round(1440 / data.length),
                    rng = Math.floor((Math.random() * 1440) + 360);

                rotation = (Math.round(rng / ps) * ps);

                picked = Math.round(data.length - (rotation % 360) / ps);
                picked = picked >= data.length ? (picked % data.length) : picked;
                if (oldpick.indexOf(picked) !== -1) {
                    d3.select(this).call(spin);
                    return;
                } else {
                    oldpick.push(picked);
                }
                rotation += 90 - Math.round(ps / 2);
                vis.transition()
                    .duration(Math.floor(Math.random() * 5000) + 3000)
                    .attrTween("transform", rotTween)
                    .each("end", function () {
                        qsoundStop();
                        //msoundPlay();
                        //mark question as seen
                        d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                            .attr("fill", "#bbb");
                        //populate question
                        d3.select("#question h1")
                            .html('<a href="question.php?id=' + data[picked].value + '" target="_blank">' + data[picked].question + '</a>');
                        oldrotation = rotation;

                        /* Get the result value from object "data" */
                        console.log(data[picked].value)

                        /* Comment the below line for restrict spin to sngle time */
                        container.on("click", spin);
                    });
            }
            //make arrow
            svg.append("g")
                .attr("transform", "translate(" + (w - w / 5.9) + "," + ((h / 2) + padding.top) + ")")
                .append("path")
                .attr("d", "M-" + (r * .15) + ",0L0," + (r * .05) + "L0,-" + (r * .05) + "Z")
                .style({ "fill": "#fff" });
            //draw spin circle
            container.append("circle")
                .attr("cx", 0)
                .attr("cy", 0)
                .attr("r", 60)
                .style({ "fill": "white", "cursor": "pointer" });
            //spin text
            container.append("text")
                .attr("x", 0)
                .attr("y", 10)
                .attr("text-anchor", "middle")
                .text("CSQUIZ24")
                .style({ "font-weight": "bold", "font-size": "24px" });


            function rotTween(to) {
                var i = d3.interpolate(oldrotation % 360, rotation);
                return function (t) {
                    return "rotate(" + i(t) + ")";
                };
            }


            function getRandomNumbers() {
                var array = new Uint16Array(1000);
                var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
                if (window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function") {
                    window.crypto.getRandomValues(array);
                    console.log("works");
                } else {
                    //no support for crypto, get crappy random numbers
                    for (var i = 0; i < 1000; i++) {
                        array[i] = Math.floor(Math.random() * 100000) + 1;
                    }
                }
                return array;
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText); // Выводим сообщение об ошибке в консоль
        }
    });
    function updateSvgSize() {
        var chart = document.getElementById('chart');
        var svg = chart.querySelector('svg');
        var chartWidth = chart.clientWidth;
        var chartHeight = chart.clientHeight;

        svg.setAttribute('width', chartWidth);
        svg.setAttribute('height', chartHeight);
    }

    // Вызываем функцию при загрузке страницы и изменении размеров окна
    window.addEventListener('load', updateSvgSize);
    window.addEventListener('resize', updateSvgSize);

});
