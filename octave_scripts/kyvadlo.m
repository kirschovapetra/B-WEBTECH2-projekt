arglist = argv();
position = str2num(arglist{1});
input0 = str2num(arglist{2});
input1 = str2num(arglist{3});
input2 = str2num(arglist{4});
input3 = str2num(arglist{5});

M = .5;
m = 0.2;
b = 0.1;
I = 0.006;
g = 9.8;
l = 0.3;
p = I*(M+m)+M*m*l^2;
A = [0 1 0 0; 0 -(I+m*l^2)*b/p (m^2*g*l^2)/p 0; 0 0 0 1; 0 -(m*l*b)/p m*g*l*(M+m)/p 0];
B = [ 0; (I+m*l^2)/p; 0; m*l/p];
C = [1 0 0 0; 0 0 1 0];
D = [0; 0];
K = lqr(A,B,C'*C,1);
Ac = [(A-B*K)];
N = -inv(C(1,:)*inv(A-B*K)*B);

sys = ss(Ac,B*N,C,D);

t = 0:0.05:10;
r = position;
initVeci = [input0, input1, input2, input3];

[y,t,x] = lsim(sys, r*ones(size(t)), t, initVeci);

%plot(t,y)
format long
disp(x(size(x,1),:)')
disp([x(:, 1), t, x(:, 3)])
