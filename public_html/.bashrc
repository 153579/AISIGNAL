# .bashrc
export PS1="[\u@ \W]\$ "
alias ll='ls -l --color=auto' 2>/dev/null
alias ls='ls --color=auto' 2>/dev/null
export LANG="ko_KR.eucKR"

# Source global definitions
if [ -f /etc/bashrc ]; then
	. /etc/bashrc
fi

# User specific aliases and functions
