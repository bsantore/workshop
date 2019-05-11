FROM nginx:1.15

# Install authbind to allow listing on port 80 as a non-root user.
RUN apt-get update && \ 
  apt-get -y install \
    authbind && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Prepare files for a non-root user.
RUN mkdir /usr/local/src/app && \
  touch /var/run/nginx.pid && \
  touch /etc/authbind/byport/80 && \
  chown www-data:www-data /etc/authbind/byport/80 && \
  chmod 500 /etc/authbind/byport/80 && \
  chown -R www-data:www-data /var/run/nginx.pid && \
  chown -R www-data:www-data /var/cache/nginx && \
  chown -R www-data:www-data /etc/nginx/conf.d/default.conf && \
  chown -R www-data:www-data /etc/nginx && \
  chown -R www-data:www-data /usr/local/src/app

# Copy configuration files and templates.
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/site.conf  /usr/local/etc/nginx/site.conf.template

# Copy the start script. This script merges envrionment variables into the 
# config file template to create the actual config file, then runs Nginx.
COPY ./docker/nginx/start /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

# Copy the application files.
COPY ./public /usr/local/src/app/public

# Set the workdir to the directory with the application files.
WORKDIR /usr/local/src/app

RUN apt-get update && \ 
  apt-get -y install \
    procps && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Run as a non-root user.
USER www-data

# Use the start script when the container starts.
CMD ["start"]
