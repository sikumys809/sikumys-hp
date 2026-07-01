/**
 * インフォグラフィック（VISION図A=#igA / Philosophy図B=#igB、常時ゆっくり動く版）。
 * モック sikumys-final-draft.html より移植。svg枠が存在するページのみ描画（＝表示中ページのみ）。
 */
(function () {
  var NS = 'http://www.w3.org/2000/svg';
  function E(t, a) {
    var e = document.createElementNS(NS, t);
    for (var k in a) { e.setAttribute(k, a[k]); }
    return e;
  }
  function SQ(g, x, y, s, opt) {
    var r = E('rect', Object.assign({ x: x - s, y: y - s, width: 2 * s, height: 2 * s, rx: 1 }, opt || {}));
    g.appendChild(r);
    return r;
  }

  /* FIG A : 横長楕円 幸せの連鎖 */
  var figA = document.getElementById('igA');
  var A = { cx: 520, cy: 275, sq: 0.40, spd: 0.13 };
  var aNodes = [], aLinks = [], aRings = [], aParts = [];
  if (figA) {
    var gOrbit = E('g', {}), gRing = E('g', {}), gLink = E('g', {}), gNode = E('g', {}), gPart = E('g', {});
    figA.appendChild(gOrbit); figA.appendChild(gRing); figA.appendChild(gLink); figA.appendChild(gNode); figA.appendChild(gPart);
    var layers = [{ r: 165, n: 6, base: 9 }, { r: 285, n: 10, base: 7 }, { r: 400, n: 15, base: 5.5 }];
    layers.forEach(function (ly) {
      gOrbit.appendChild(E('ellipse', { cx: A.cx, cy: A.cy, rx: ly.r, ry: ly.r * A.sq, fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1, opacity: 0.12 }));
    });
    var cs0 = 34;
    var centerRect = SQ(gNode, A.cx, A.cy, cs0, { fill: '#4FD2F5', rx: 5 });
    centerRect.style.filter = 'drop-shadow(0 0 22px rgba(79,210,245,.9))';
    var ct = E('text', { x: A.cx, y: A.cy + 4, 'text-anchor': 'middle', fill: '#00030C', 'font-size': 13, 'class': 'lbl', 'font-weight': 900 });
    ct.textContent = 'SIKUMYS';
    ct.style.letterSpacing = '1px';
    figA.appendChild(ct);
    A.center = { el: centerRect, base: cs0 };
    var prev = [{ center: true, x: A.cx, y: A.cy }];
    layers.forEach(function (ly, li) {
      var cur = [];
      for (var i = 0; i < ly.n; i++) {
        var baseAng = (-90 + 360 / ly.n * i + li * 11) * Math.PI / 180;
        var nd = { baseAng: baseAng, r: ly.r, base: ly.base, li: li, x: A.cx, y: A.cy };
        nd.el = SQ(gNode, A.cx, A.cy, ly.base, { fill: '#0b2340', stroke: '#4FD2F5', 'stroke-width': 1.4 });
        nd.el.style.filter = 'drop-shadow(0 0 6px rgba(79,210,245,.5))';
        aNodes.push(nd); cur.push(nd);
      }
      cur.forEach(function (nd) {
        var best = prev[0], bd = 1e9;
        prev.forEach(function (q) {
          var qa = q.center ? nd.baseAng : q.baseAng;
          var d = Math.abs(((nd.baseAng - qa + Math.PI) % (2 * Math.PI)) - Math.PI);
          if (d < bd) { bd = d; best = q; }
        });
        aLinks.push({ a: nd, b: best, el: E('line', { stroke: '#4FD2F5', 'stroke-width': 1, opacity: 0.28 }) });
      });
      prev = cur;
    });
    aLinks.forEach(function (l) { gLink.appendChild(l.el); });
    for (var ri = 0; ri < 4; ri++) {
      var r = E('ellipse', { cx: A.cx, cy: A.cy, fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1 });
      gRing.appendChild(r);
      aRings.push({ el: r, ph: ri / 4 });
    }
    for (var pi = 0; pi < 20; pi++) {
      var ang = (360 / 20 * pi) * Math.PI / 180;
      var d = SQ(gPart, A.cx, A.cy, 2, { fill: '#9fe6fb', rx: 0 });
      aParts.push({ el: d, ang: ang, ph: pi / 20 });
    }
  }
  function drawA(t) {
    if (!figA) { return; }
    var cs = A.center.base * (1 + 0.06 * Math.sin(t * 2));
    A.center.el.setAttribute('x', A.cx - cs); A.center.el.setAttribute('y', A.cy - cs);
    A.center.el.setAttribute('width', 2 * cs); A.center.el.setAttribute('height', 2 * cs);
    aNodes.forEach(function (o) {
      var ang = o.baseAng + t * A.spd;
      o.x = A.cx + Math.cos(ang) * o.r; o.y = A.cy + Math.sin(ang) * o.r * A.sq;
      var depth = (Math.sin(ang) + 1) / 2;
      var s = o.base * (0.65 + 0.55 * depth) * (1 + 0.1 * Math.sin(t * 1.6 + o.li));
      o.el.setAttribute('x', o.x - s); o.el.setAttribute('y', o.y - s);
      o.el.setAttribute('width', 2 * s); o.el.setAttribute('height', 2 * s);
      o.el.setAttribute('opacity', 0.45 + 0.55 * depth);
      o.el.style.filter = 'drop-shadow(0 0 ' + (3 + depth * 6) + 'px rgba(79,210,245,' + (0.4 + depth * 0.4) + '))';
    });
    aLinks.forEach(function (l) {
      var bx = l.b.center ? A.cx : l.b.x, by = l.b.center ? A.cy : l.b.y;
      l.el.setAttribute('x1', bx); l.el.setAttribute('y1', by);
      l.el.setAttribute('x2', l.a.x); l.el.setAttribute('y2', l.a.y);
      var depth = (Math.sin(l.a.baseAng + t * A.spd) + 1) / 2;
      l.el.setAttribute('opacity', 0.12 + 0.26 * depth);
    });
    aRings.forEach(function (o) {
      var f = ((t * 0.15 + o.ph) % 1);
      o.el.setAttribute('rx', 20 + f * 400); o.el.setAttribute('ry', (20 + f * 400) * A.sq);
      o.el.setAttribute('opacity', (1 - f) * 0.28);
    });
    aParts.forEach(function (o) {
      var f = ((t * 0.17 + o.ph) % 1); var rr = f * 400;
      var x = A.cx + Math.cos(o.ang) * rr, y = A.cy + Math.sin(o.ang) * rr * A.sq;
      o.el.setAttribute('x', x - 2); o.el.setAttribute('y', y - 2);
      o.el.setAttribute('opacity', Math.sin(f * Math.PI) * 0.8);
    });
  }

  /* FIG B : 個人 -> 企業 -> 世界 */
  var figB = document.getElementById('igB');
  var B = { y: 225, cx: [170, 480, 790] };
  var s1 = [], s2 = [], hexEl, globe, flow = [];
  function hex(cx, cy, r) {
    var s = '';
    for (var i = 0; i < 6; i++) { var a = (-90 + 60 * i) * Math.PI / 180; s += (cx + Math.cos(a) * r) + ',' + (cy + Math.sin(a) * r) + ' '; }
    return s.trim();
  }
  if (figB) {
    var gLinkB = E('g', {}), gFlow = E('g', {}), gWorld = E('g', {}), gNodeB = E('g', {});
    figB.appendChild(gLinkB); figB.appendChild(gFlow); figB.appendChild(gWorld); figB.appendChild(gNodeB);
    var off = [[-42, -46], [40, -30], [-30, 34], [46, 42], [2, -2], [-54, 10], [18, 58]];
    off.forEach(function (o, i) {
      var x = B.cx[0] + o[0], y = B.y + o[1];
      var r = SQ(gNodeB, x, y, 8, { fill: '#0b2340', stroke: '#4FD2F5', 'stroke-width': 1.4 });
      r.style.filter = 'drop-shadow(0 0 6px rgba(79,210,245,.5))';
      s1.push({ el: r, bx: x, by: y, ph: i });
    });
    for (var i2 = 0; i2 < 7; i2++) {
      var angB = (-90 + 60 * i2) * Math.PI / 180, rr2 = i2 === 6 ? 0 : 42;
      var x2 = B.cx[1] + Math.cos(angB) * rr2, y2 = B.y + Math.sin(angB) * rr2;
      var r2 = SQ(gNodeB, x2, y2, i2 === 6 ? 12 : 8, { fill: i2 === 6 ? '#4FD2F5' : '#0b2340', stroke: '#4FD2F5', 'stroke-width': 1.4 });
      r2.style.filter = 'drop-shadow(0 0 8px rgba(79,210,245,.6))';
      s2.push({ el: r2, x: x2, y: y2, base: i2 === 6 ? 12 : 8 });
    }
    hexEl = E('polygon', { points: hex(B.cx[1], B.y, 58), fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1.2, opacity: 0.5 });
    gNodeB.appendChild(hexEl);
    var wc = B.cx[2], wr = 76;
    globe = E('g', {}); globe._wc = wc; globe._wr = wr;
    globe.appendChild(E('circle', { cx: wc, cy: B.y, r: wr, fill: 'rgba(79,210,245,.05)', stroke: '#4FD2F5', 'stroke-width': 1.6 }));
    globe._mer = [];
    for (var m1 = 0; m1 < 4; m1++) {
      var m = E('ellipse', { cx: wc, cy: B.y, rx: wr, ry: wr, fill: 'none', stroke: '#4FD2F5', 'stroke-width': 0.9, opacity: 0.5 });
      globe.appendChild(m); globe._mer.push(m);
    }
    for (var l1 = 1; l1 <= 2; l1++) {
      var ry1 = wr * (l1 / 3);
      globe.appendChild(E('ellipse', { cx: wc, cy: B.y, rx: wr, ry: ry1, fill: 'none', stroke: '#4FD2F5', 'stroke-width': 0.8, opacity: 0.4 }));
    }
    globe.appendChild(E('circle', { cx: wc, cy: B.y, r: wr, fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1.6 }));
    gWorld.appendChild(globe);
    s1.forEach(function (n) { gLinkB.appendChild(E('line', { x1: n.bx, y1: n.by, x2: B.cx[1], y2: B.y, stroke: '#4FD2F5', 'stroke-width': 1, opacity: 0.2 })); });
    gLinkB.appendChild(E('line', { x1: B.cx[1] + 58, y1: B.y, x2: wc - wr, y2: B.y, stroke: '#4FD2F5', 'stroke-width': 1.4, opacity: 0.4 }));
    s1.forEach(function (n, i) { var d = SQ(gFlow, 0, 0, 2.4, { fill: '#9fe6fb', rx: 0 }); flow.push({ el: d, x1: n.bx, y1: n.by, x2: B.cx[1], y2: B.y, ph: i / 7, sp: 0.22 }); });
    for (var f1 = 0; f1 < 4; f1++) { var df = SQ(gFlow, 0, 0, 2.6, { fill: '#9fe6fb', rx: 0 }); flow.push({ el: df, x1: B.cx[1] + 58, y1: B.y, x2: wc - wr, y2: B.y, ph: f1 / 4, sp: 0.3 }); }
    (function (x) { figB.appendChild(E('path', { d: 'M' + x + ' ' + (B.y - 7) + ' L' + (x + 14) + ' ' + B.y + ' L' + x + ' ' + (B.y + 7), fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1.6, opacity: 0.7, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' })); })((B.cx[0] + B.cx[1]) / 2 - 7);
    (function (x) { figB.appendChild(E('path', { d: 'M' + x + ' ' + (B.y - 7) + ' L' + (x + 14) + ' ' + B.y + ' L' + x + ' ' + (B.y + 7), fill: 'none', stroke: '#4FD2F5', 'stroke-width': 1.6, opacity: 0.7, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' })); })((B.cx[1] + B.cx[2]) / 2 - 7);
    [['Rich Life', '豊かな人生', B.cx[0]], ['Rich Company', '豊かな企業', B.cx[1]], ['Rich World', '豊かな世界', B.cx[2]]].forEach(function (l) {
      var t1 = E('text', { x: l[2], y: B.y + 128, 'text-anchor': 'middle', fill: '#4FD2F5', 'font-size': 13, 'class': 'lbl', 'font-weight': 700 });
      t1.textContent = l[0]; t1.style.letterSpacing = '2px'; figB.appendChild(t1);
      var t2 = E('text', { x: l[2], y: B.y + 150, 'text-anchor': 'middle', fill: '#fff', 'font-size': 15, 'class': 'lbljp', 'font-weight': 700 });
      t2.textContent = l[1]; t2.style.letterSpacing = '2px'; figB.appendChild(t2);
    });
  }
  function drawB(t) {
    if (!figB) { return; }
    s1.forEach(function (n) {
      var x = n.bx + Math.sin(t * 0.8 + n.ph) * 5, y = n.by + Math.cos(t * 0.7 + n.ph * 1.3) * 5;
      n.el.setAttribute('x', x - 8); n.el.setAttribute('y', y - 8);
    });
    hexEl.setAttribute('transform', 'rotate(' + (t * 6) + ' ' + B.cx[1] + ' ' + B.y + ') scale(' + (1 + 0.04 * Math.sin(t * 1.4)) + ')');
    hexEl.style.transformOrigin = B.cx[1] + 'px ' + B.y + 'px';
    s2.forEach(function (o, i) {
      var s = o.base * (1 + 0.1 * Math.sin(t * 1.6 + i));
      o.el.setAttribute('x', o.x - s); o.el.setAttribute('y', o.y - s);
      o.el.setAttribute('width', 2 * s); o.el.setAttribute('height', 2 * s);
    });
    globe._mer.forEach(function (m, i) {
      var rx = Math.abs(Math.cos(t * 0.5 + i * Math.PI / 4)) * globe._wr;
      m.setAttribute('rx', Math.max(1, rx));
      m.setAttribute('opacity', 0.2 + 0.4 * (rx / globe._wr));
    });
    flow.forEach(function (f) {
      var p = ((t * f.sp + f.ph) % 1);
      f.el.setAttribute('x', f.x1 + (f.x2 - f.x1) * p - 2.4);
      f.el.setAttribute('y', f.y1 + (f.y2 - f.y1) * p - 2.4);
      f.el.setAttribute('opacity', Math.sin(p * Math.PI) * 0.85);
    });
  }

  if (!figA && !figB) {
    return;
  }
  var t0 = performance.now();
  function loop() {
    var t = (performance.now() - t0) / 1000;
    if (figA) { drawA(t); }
    if (figB) { drawB(t); }
    requestAnimationFrame(loop);
  }
  drawA(0); drawB(0); loop();
})();
