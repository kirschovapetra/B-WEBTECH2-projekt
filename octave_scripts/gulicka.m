%http://ctms.engin.umich.edu/CTMS/index.php?example=BallBeam&section=ControlStateSpace
%vstup: požadovaná nová poloha guličky na tyči r
%výstup: aktuálna pozícia guličky N*x(:,1) a aktuálny náklon tyče (uhol v radiánoch) x(:,3),

arglist = argv();
position = str2num(arglist{1});
input0 = str2num(arglist{2});
input1 = str2num(arglist{3});
input2 = str2num(arglist{4});
input3 = str2num(arglist{5});

function getResult(r,input)

    m = 0.111;
    R = 0.015;
    g = -9.8;
    J = 9.99e-6;
    H = -m*g/(J/(R^2)+m);
    A = [0 1 0 0; 0 0 H 0; 0 0 0 1; 0 0 0 0];
    B = [0;0;0;1];
    C = [1 0 0 0];
    D = [0];
    K = place(A,B,[-2+2i,-2-2i,-20,-80]);
    N = -inv(C*inv(A-B*K)*B);

    sys = ss(A-B*K,B,C,D);


    t = 0:0.01:5;
%    t = 0:0.01:0.05;

%    r =0.25; - metre

%    initRychlost=0;
%    initZrychlenie=0;
    [y,t,x]=lsim(N*sys,r*ones(size(t)),t,input);
%  [y,t,x]=lsim(N*sys,r*ones(size(t)),t,[initRychlost;0;initZrychlenie;0]);
%

format long
disp(x(size(x,1),:)')
disp([N*x(:,1),t,x(:,3)])

%%   r =0.5;
  % [y,t,x]=lsim(N*sys,r*ones(size(t)),t,x(size(x,1),:));

endfunction

getResult(position, [input0;input1;input2;input3]);