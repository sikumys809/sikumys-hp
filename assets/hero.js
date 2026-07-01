/**
 * ヒーロー背景の3DCG NETWORK（スクロール連動）。モック sikumys-final-draft.html より移植。
 * #bg canvas が存在するページ（＝トップ）でのみ動作。Three.js に依存。
 */
(function () {
  var bg = document.getElementById('bg');
  if (!bg || !window.THREE) {
    return;
  }

  var reduce = matchMedia('(prefers-reduced-motion:reduce)').matches;
  var mobile = innerWidth < 760;

  var renderer = new THREE.WebGLRenderer({ canvas: bg, antialias: true, alpha: true });
  renderer.setClearColor(0, 0);

  var SKY = new THREE.Color(0x4fd2f5);
  var scene = new THREE.Scene();
  var cam = new THREE.PerspectiveCamera(56, 1, 0.1, 100);
  cam.position.z = 9;

  var grp = new THREE.Group();
  scene.add(grp);

  var N = mobile ? 46 : 92, base = [], np = new Float32Array(N * 3);
  for (var i = 0; i < N; i++) {
    base.push(new THREE.Vector3((Math.random() - 0.5) * 9, (Math.random() - 0.5) * 9, (Math.random() - 0.5) * 9));
  }

  var ng = new THREE.BufferGeometry();
  ng.setAttribute('position', new THREE.BufferAttribute(np, 3));
  grp.add(new THREE.Points(ng, new THREE.PointsMaterial({ color: SKY, size: 0.12, transparent: true, opacity: 0.95, sizeAttenuation: true })));

  var lg = new THREE.BufferGeometry();
  var lines = new THREE.LineSegments(lg, new THREE.LineBasicMaterial({ color: SKY, transparent: true, opacity: 0.16 }));
  grp.add(lines);

  var TH = 2.5;
  var mouse = { x: 0, y: 0, tx: 0, ty: 0 };
  addEventListener('mousemove', function (e) {
    mouse.tx = e.clientX / innerWidth - 0.5;
    mouse.ty = e.clientY / innerHeight - 0.5;
  });

  var sp = 0, last = 0, vel = 0;

  function resize() {
    var dpr = Math.min(devicePixelRatio, mobile ? 1.5 : 2);
    renderer.setPixelRatio(dpr);
    renderer.setSize(innerWidth, innerHeight, false);
    cam.aspect = innerWidth / innerHeight;
    cam.updateProjectionMatrix();
  }
  addEventListener('resize', resize);
  resize();

  var clock = new THREE.Clock();

  function frame() {
    var t = clock.getElapsedTime();
    var prog = Math.min(1, window.scrollY / Math.max(1, innerHeight));
    sp += (prog - sp) * 0.08;
    vel = Math.abs(sp - last);
    last = sp;
    mouse.x += (mouse.tx - mouse.x) * 0.05;
    mouse.y += (mouse.ty - mouse.y) * 0.05;
    cam.position.z = 9 - sp * 3.4;
    cam.position.x += (mouse.x * 1.2 - cam.position.x) * 0.05;
    cam.position.y += (-mouse.y * 0.9 - cam.position.y) * 0.05;
    cam.lookAt(0, 0, 0);
    grp.rotation.y = sp * Math.PI * 0.9 + t * 0.04;
    grp.rotation.x = sp * 0.35;
    var spread = 0.7 + sp * 0.55;
    for (var i = 0; i < N; i++) {
      var b = base[i];
      np[i * 3] = b.x * spread + Math.sin(t * 0.4 + i) * 0.18;
      np[i * 3 + 1] = b.y * spread + Math.cos(t * 0.3 + i * 1.2) * 0.18;
      np[i * 3 + 2] = b.z * spread;
    }
    ng.attributes.position.needsUpdate = true;
    var seg = [];
    for (var a = 0; a < N; a++) {
      for (var c = a + 1; c < N; c++) {
        var ax = np[a * 3], ay = np[a * 3 + 1], az = np[a * 3 + 2],
          bx = np[c * 3], by = np[c * 3 + 1], bz = np[c * 3 + 2];
        if (Math.hypot(ax - bx, ay - by, az - bz) < TH) {
          seg.push(ax, ay, az, bx, by, bz);
        }
      }
    }
    lg.setAttribute('position', new THREE.BufferAttribute(new Float32Array(seg), 3));
    lines.material.opacity = 0.12 + Math.min(vel * 6, 0.45);
    renderer.render(scene, cam);
    requestAnimationFrame(frame);
  }

  bg.classList.add('on');
  if (reduce) {
    renderer.render(scene, cam);
  } else {
    frame();
  }
})();
