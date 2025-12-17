FROM python:3.12-slim

RUN apt-get update && apt-get install -y \
    ansible \
    openssh-server \
    openssh-client \
    && rm -rf /var/lib/apt/lists/*

RUN useradd -m ansible

RUN mkdir -p /home/ansible/.ssh \
    && chown ansible:ansible /home/ansible/.ssh \
    && chmod 700 /home/ansible/.ssh
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
EXPOSE 22
CMD ["/entrypoint.sh"]
