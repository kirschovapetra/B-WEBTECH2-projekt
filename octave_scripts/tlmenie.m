%http://ctms.engin.umich.edu/CTMS/index.php?example=Suspension&section=ControlStateSpace
pkg load control;
warning('off','all');

arglist = argv();
r = str2num(arglist{1});
input0 = str2num(arglist{2});
input1 = str2num(arglist{3});
input2 = str2num(arglist{4});
input3 = str2num(arglist{5});
input4 = str2num(arglist{6});

m1 = 2500; m2 = 320;
k1 = 80000; k2 = 500000;
b1 = 350; b2 = 15020;
A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];
B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];
C=[0 0 1 0]; D=[0 0];
Aa = [[A,[0 0 0 0]'];[C, 0]];
Ba = [B;[0 0]];
Ca = [C,0]; Da = D;
K = [0 2.3e6 5e8 0 8e6];
sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);

t = 0:0.01:5;
%r =0.1;
%initX1=0;
%initX1d=0;
%initX2=0;
%initX2d=0;
[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[input0;input1;input2;input3;input4]);
%plot(t,y)
disp(x(size(x,1),:)')
disp([x(:, 1), t, x(:, 3)])

% r = -0.1;
%[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,x(size(x,1),:));
%plot(t,y)

%odporucam si pozriet aj tento graf. Takto to vyzera, ked tam nie je pouzity regulator pre tlmic
%sys0 = ss(A,B,C,D);
%[y0,t,x0]=lsim(sys0*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d]);
%plot(t,y0,t,y)