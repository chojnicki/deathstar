#
# Develop stage
#
FROM node:16-alpine AS dev

ARG UID=1000
ARG GID=1000
ARG VITE_API_URL

RUN apk add --update --no-cache \ 
    libc6-compat \
    gcompat \
    mesa-dev \
    libxi

RUN deluser node && \
    addgroup -g $GID node && \
    adduser -u $UID -G node -s /bin/sh -D node

USER node

WORKDIR /usr/src/app


#
# Build stage
#
FROM dev AS build

USER root

COPY package.json yarn.lock ./
RUN yarn --frozen-lockfile --verbose

COPY . .

RUN yarn build


#
# Production stage
#
FROM nginx:alpine AS prod

WORKDIR /usr/share/nginx/html

COPY --from=build /usr/src/app/dist .

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
