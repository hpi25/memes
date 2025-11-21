{
  pkgs ? import <nixpkgs> { },
  ...
}:
let
  extensions =
    { enabled, all }:
    enabled
    ++ [
      all.uv
      all.gmp
    ];
in
pkgs.mkShell {
  packages = with pkgs; [
    (php84.buildEnv { inherit extensions; })
    php84Packages.composer
  ];
}
